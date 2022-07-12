<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Payment;




class StripeController extends Controller
{
    public function render(Order $order){
        $client = Auth::user()->client;
        $stripeCustomer = $client->createOrGetStripeCustomer();


       
        if(is_null($order->payment)){

            $payment =$client->payWith(
                $order->total * 100 , []
            );
            $paymentIntent = Arr::only($payment->asStripePaymentIntent()->toArray(), [
                'id', 'status', 'payment_method_types', 'client_secret', 'payment_method',
            ]);

            $payment = new \App\Models\OrderPayment() ; 
            $payment->order_id = $order->id ;
            $payment->stripe_intent_id = $paymentIntent['id'];
            $payment->save();

        }else{  
            $payment  =  $order->payment ;
            if($payment->stripe_intent_id == "" || is_null($payment->stripe_intent_id)){
                
                $paymentSt =$client->payWith(
                    $order->total * 100 , []
                );
                $paymentIntent = Arr::only($paymentSt->asStripePaymentIntent()->toArray(), [
                    'id', 'status', 'payment_method_types', 'client_secret', 'payment_method',
                ]);

                $payment->stripe_intent_id = $paymentIntent['id'] ;
                $payment->save();
            }
        }

  

        return view('payment', [
            'stripeKey' => config('cashier.key'),
            'amount' => $order->total * 100 ,
            'payment' => $payment,
            'order' => $order,
            // 'paymentMethod' => (string) request('source_type', optional($payment->payment_method)->type),
            'paymentMethod' => (string) '',
            'errorMessage' => request('redirect_status') === 'failed'
                ? 'Something went wrong when trying to confirm the payment. Please try again.'
                : '',
            'customer' => $stripeCustomer,
            'redirect' => route('orders.show',[$order]) ,
        ]);

    }

    public function processPayment(Request $request)
    {
       
        $payment  = \App\Models\OrderPayment::find($request->input('payment'));
        $paymentIntent = Cashier::stripe()->paymentIntents->retrieve( $payment->stripe_intent_id, ['expand' => ['payment_method']]);
        $paymentMethod = $request->input('stripepaymentMethod');
      
       
        
        try{
            //if($paymentIntent->status === 'succeeded') throw new \Exception('You cannot confirm this Payment because it has already succeeded after being previously confirmed.');
            Auth::user()->client->updateDefaultPaymentMethod($paymentMethod);
            $paymentIntent->confirm(['payment_method'=> $paymentMethod]);
           
        }catch (\Exception $e){
            return back()->withErrors(['message' =>  $e->getMessage()]);
        }
        // $payment->status = 'succeeded' ;
        // $payment->save() ;

        $payment->changeStatus('succeeded') ;
        
        return back()->with(['success' =>  'bien']);
    }


}
