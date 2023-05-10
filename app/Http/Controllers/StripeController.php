<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'=>[
                [
                    'price_date'=>[
                        'currency'=>'PLN',
                        'product_date'=>[
                            'name'=>'Sennd me money',
                        ],
                        'unit_amount'=>500,
                    ],
                    'quantity'=>1,
                ],
            ],
            'mode'=>'payment',
            'success_url'=>route('success'),
            'cancel_url'=>route('index'),
        ]);
        return redirect()->away($session->url);
    }
    public function success()
    {
        return view('index');
    }
}