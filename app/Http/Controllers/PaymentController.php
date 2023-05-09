<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\Cart;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Devpark\Transfers24\Requests\Transfers24;


class PaymentController extends Controller
{
    private Transfers24 $transfers24;


    public function __construct(Transfers24 $transfers24)
    {
        $this->transfers24=$transfers24;       
      
    }

    


    /**
     *
     * Display a listing of the resource.
     */
    public function status(Request $request)
    {
        
        $response =  $this->transfers24->receive($request);
        $payment = Payment::where('session_id',$response->getSessionId())->firstOrFail();


        if ($response->isSuccess()) {
            
           $payment->status = PaymentStatus::Succes;
        }else{
            $payment->status=   PaymentStatus::FAIL;             
            $payment->error_code = $response ->getErrorCode();
            $payment->error_description =json_encode( $response ->getErrorDescription());
            $payment->save();
        }
       

       
    }  
   
}
