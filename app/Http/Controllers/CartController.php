<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\View\View;
use Synfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use Exception;

class CartController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cart.index', [
            'cart'=> Session::get('cart',new Cart())
        ]);
    }
    
    public function store(Product $product)
    {
        $cart=Session::get('cart', new Cart());

        Session::put('cart',$cart->addItem($product));
       return response()->json([
            'status' => 'success'
        ]);
    }

    public function destroy(Product $product)
    {
        try{
            $cart=Session::get('cart', new Cart());
            Session::put('cart',$cart->removeItem($product));  
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


}
