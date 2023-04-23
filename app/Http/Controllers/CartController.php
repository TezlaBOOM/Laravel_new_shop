<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\View\View;
use Synfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Dtos\Cart\CartDtos;
use App\Dtos\Cart\CartItemDtos;

class CartController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Session::get('cart', new CartDtos()));
        return view('home');
    }
    public function store(Product $product)
    {
        $cart=Session::get('cart', new CartDtos());
        $item= $cart->getItem();
        if(Arr::exists($item,$product->id)){
            $item[$product->id] -> incrementQuantity();
        }else{
            $cartItemDtios = new CartItemDtos();
            $cartItemDtios->setProductId($product->id);
            $cartItemDtios->setName($product->name);
            $cartItemDtios->setPrice($product->price);
            $cartItemDtios->setImagePath($product->image_path);
            $cartItemDtios->setQuantity(1);
            $items[$product->id] = $cartItemDtios;

        }
        $cart->setItems($item);
        $cart->incerementtotalQuantity();
        $cart->incerementtotalSum($product->price);
        Session::put('cart',$cart);
       return response()->json([
            'status' => 'success'
        ]);
    }

}
