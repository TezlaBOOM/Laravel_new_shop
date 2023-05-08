<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;

use App\ValueObjects\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class PaypalController extends Controller
{
    private $gateway;

    public function __construct(){
        $this->gateway = Omnipay::create('Paypal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }
    public function PaypalTrnsaction(Request $request)
    {
        $cart = Session::get('cart',new Cart());
        try{
            $response=$this->gateway->purchase(array(
                'amount'=>$request->amount,
                'currency'=>env('PAYPAL_CURRENCY'),
                'returnUrl'=>url('success'),
                'cancelUrl'=>url('error'),
            ))->send();
            if($response->isRedirect())
            {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }
}


