<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\View\View;
use Synfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;

class CartController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd(Session::get('cart', new Cart()));
        return view('home');
    }
    
    public function store(Product $product)
    {
        $cart=Session::get('cart', new Cart());

        Session::put('cart',$cart->addItem($product));
       return response()->json([
            'status' => 'success'
        ]);
    }

}
