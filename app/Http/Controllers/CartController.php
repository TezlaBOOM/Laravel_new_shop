<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\View\View;
use Synfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Dtos\Cart\CartDto;
use App\Dtos\Cart\CartItemDto;

class CartController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Session::get('cart', new CartDto()));
        return view('home');
    }
    
    public function store(Product $product)
    {
        $cart=Session::get('cart', new CartDto());
        $item = $cart->getItems();
        if(Arr::exists( $item, $product->id)){
            $item[$product->id] -> incrementQuatity();
        }else{
            $cartItemDto = new CartItemDto();
            $cartItemDto->setProductId($product->id);
            $cartItemDto->setName($product->name);
            $cartItemDto->setPrice($product->price);
            //$cartItemDto->setImagePath($product->image_path);
            $cartItemDto->setQuantity(1);
            $item[$product->id] = $cartItemDto;

        }
        $cart->setItems($item);
        $cart->incrementtotalQuantity();
        $cart->incrementtotalSum($product->price);
        Session::put('cart',$cart);
       return response()->json([
            'status' => 'success'
        ]);
    }

}
