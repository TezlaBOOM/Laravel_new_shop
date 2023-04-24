<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\StoreProductRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index',[
            'products'=> Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create',[
            'categories' => ProductCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->image_path = $request->file("image")->store('products');
        $product -> save();
        return redirect(route('products.index'))->with('status',__('sklep.product.status.store.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show",[
            'categories' => ProductCategory::all(),
            'product'=> $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */
    public function edit(Product $product) 
    {
        return view('products.edit',[
            'categories' => ProductCategory::all(),
            'product'=> $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $oldImagePath = $product->image_path;
        $product->fill($request->validated());
        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($oldImagePath)){
                Storage::disk('public')->delete($oldImagePath);
            }
            $product->image_path = $request->file("image")->store('products');
        }
        $product->save();
        return redirect(route('products.index'))->with('status',__('sklep.product.status.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $id = $product->id;
            Product::find($id)->delete($id);       
            Session::flash('status',__('sklep.product.status.delete.success'));
            return response()->json([    
                'success' => 'Record deleted successfully!'
                ]);
            } catch(Exception $e){
               return response()->json([    
                'error' => 'Error!'
                ]);
            }
     }


public function downloadImage(Product $product)
{
    if(Storage::exists($product->image_path))
        {
            return Storage::download($product->image_path,$product->name . '-' . $product->id . '.jpg');
         }

    return Redirect::back();    
}

}