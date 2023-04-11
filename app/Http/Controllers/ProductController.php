<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\StoreProductRequest;


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
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->image_path = $request->file("image")->store('products');
        $product -> save();
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show",[
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
            'product'=> $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        if($request->hasFile('image')){
            $product->image_path = $request->file("image")->store('products');
        }
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $id = $product->id;
            Product::find($id)->delete($id);       
            return response()->json([    
                'success' => 'Record deleted successfully!'
                ]);
            } catch(Exception $e){
               return response()->json([    
                'error' => 'Error!'
                ]);
            }
     }
}
