<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Payment;
use App\Http\Controllers\StripeTrait ;




class StripeController extends Controller
{
    use StripeTrait ;

    public function render(Order $order){
        $client = Auth::user()->client;
        
        $result = $this->paymentItent($client,$order) ;
  

        return view('client.payment', [
            
            'title' => __('Payment Confirmation'),
            'client' => $client ,
            'stripeKey' => config('cashier.key'),
            'amount' => $order->total * 100 ,
            'payment' => $result['payment'],
            'order' => $order,
            // 'paymentMethod' => (string) request('source_type', optional($payment->payment_method)->type),
            'paymentMethod' => (string) '',
            'errorMessage' => request('redirect_status') === 'failed'
                ? 'Something went wrong when trying to confirm the payment. Please try again.'
                : '',
            'customer' => $result['customer'],
            'redirect' => route('orders.show',[$order]) ,
        ]);

    }

    public function processPayment(Request $request)
    {
        \App\Models\OrderPayment::validatePayment($request->input());
        $payment  = \App\Models\OrderPayment::find($request->input('payment'));
       
        $paymentIntent = Cashier::stripe()->paymentIntents->retrieve( $payment->stripe_intent_id, ['expand' => ['payment_method']]);
        $paymentMethod = $request->input('stripepaymentMethod');
      
       
        
        try{
            Auth::user()->client->updateDefaultPaymentMethod($paymentMethod);
            $paymentIntent->confirm(['payment_method'=> $paymentMethod]);
           
        }catch (\Exception $e){
            return back()->withErrors(['message' =>  $e->getMessage()]);
        }

        $payment->changeStatus('succeeded') ;
        $payment->order->changeStatus('paid') ;
        
        return back()->with(['success' =>  'bien']);
    }


}
