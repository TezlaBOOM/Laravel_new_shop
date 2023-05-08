<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentPaypal;
use App\ValueObjects\Cart;
use Devpark\Transfers24\Exceptions\RequestException;
use Devpark\Transfers24\Exceptions\RequestExecutionException;
use Devpark\Transfers24\Requests\Transfers24;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PaypalController;
use Omnipay\Omnipay;
class OrderController extends Controller
{
    private Transfers24 $transfers24;
    private $gateway;
    public function __construct(Transfers24 $transfers24)
    {
        $this->transfers24 = $transfers24;


        $this->gateway = Omnipay::create('Paypal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function index(): View
    {
        return view("orders.index", [
            'orders' => Order::where('user_id', Auth::id())->paginate(10)
           
        ]);
    }

    public function store( Request $request)
    {
        $cart = Session::get('cart', new Cart());
        if ($cart->hasItems()) {
            $order = new Order();
            $order->quantity = $cart->getQuantity();
            $order->price = $cart->getSum();
            $order->user_id = Auth::id();
            $order->payment_categories_id= $request->input('payment_category');
            $order->save();
            $productIds = $cart->getItems()->map(function ($item) {
                return ['product_id' => $item->getProductId()];
            });
            $order->products()->attach($productIds);
            $method= $request->input('payment_category');
            if ($method == 1){
                
                return $this->paymentTransaction($order);
            }else if ($method == 2){

            }else if ($method == 3){
            
                return $this->PaypalTrnsaction();
            }else{

            }

        }
        return back();
    }



    

    
    public function PaypalTrnsaction()
    {
        $cart = Session::get('cart',new Cart());
        try{
            $response=$this->gateway->purchase(array(
                'amount'=>$cart->getSum(),
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
    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if ($response->isSuccessful()) {

                $arr = $response->getData();

                $payment = new PaymentPaypal;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];

                $payment->save();

                return redirect()->route('orders.index');

            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return 'Payment declined!!';
        }
    }

    public function error()
    {
        return 'User declined the payment!';   
    }






























    private function paymentTransaction(Order $order)
    {
        $payment = new Payment();
        $payment->order_id = $order->id;
        $this->transfers24->setEmail(Auth::user()->email)->setAmount($order->price);
        try {
            $response = $this->transfers24->init();
            if ($response->isSuccess()) {
                $payment->status = PaymentStatus::IN_PROGRESS;
                $payment->session_id = $response->getSessionId();
                $payment->save();
                Session::put('cart', new Cart());
                return redirect($this->transfers24->execute($response->getToken()));
            } else {
                $payment->status = PaymentStatus::FAIL;
                $payment->error_code = $response->getErrorCode();
                $payment->error_description = json_encode($response->getErrorDescription());
                $payment->save();
                return back()->with('error', 'Ups... Coś poszło nie tak!');
            }
        } catch (RequestException|RequestExecutionException $error) {
            Log::error("Błąd transakcji", ['error' => $error]);
            return back()->with('error', 'Ups... Coś poszło nie tak!');
        }
    }

}
