<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('products.index' , [
            'products' => Product::paginate(10),
            'categories' => ProductCategory::all(),
         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create' , [
            'categories' => ProductCategory::all()
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *  
     * 
     */
    public function store(StoreProductRequest $request)  
    {
       
        $product = new Product($request->validated());
        if ($request->hasFile('image')) {
        $product->image_path = Storage::disk('public')->putFile('products', $request->file('image'));
        }
        $product->save();
        return redirect()->route('products.index')->with('status', 'Product Stored !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show' , [
            'product' => $product,
            'categories' => ProductCategory::all()
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit' , [
            'categories' => ProductCategory::all(),
            'product' => $product
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $oldImagePath = $product->image_path;

        $product->fill($request->validated());
        if ($request->hasFile('image')){
            if(Storage::disk('public')->exists($oldImagePath)){
                Storage::disk('public')->delete($oldImagePath);
            }
            $product->image_path = Storage::disk('public')->putFile('products', $request->file('image')); 
        }
        $product->save();
        return redirect()->route('products.index')->with('status', 'Product Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        try{
            $id = $product->id;
            
             Product::find($id)->delete($id);  
             Session::flash('status', 'Product Deleted Successfully !'); 
            return response()->json([    
                'succes' => 'Record deleted successfully!',                
                ]);
                
            } catch(Exception $e){
               return response()->json([    
                'error' => 'Error!'
            ]);
            }
            
    }

    /**
     * Download image the specified resource in storage.
     */
    public function downloadImage(Product $product)
    {       
       
            if(Storage::disk('public')->exists($product->image_path)){
                return Storage::disk('public')->download($product->image_path, $product->name . '-' . $product->id . '.jpg');
            }       

        return back();
        }


}
