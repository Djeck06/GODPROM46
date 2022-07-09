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

            $payment = new \App\Models\OrderPayment(['stripe_intent_id'=> $paymentIntent['id']]);
            $order->payment()->save($payment);
        }else{

            $payment  =  $order->payment ;
            //dd($payment->strip_intent_id) ;
            //$paymentIntent = Cashier::stripe()->paymentIntents->retrieve( $payment->strip_intent_id, ['expand' => ['payment_method']]);
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

        // return view('client.order.payment', [
        //     'title' => __('Payment Verification #') . $order->reference,
        //     'order' => $order,
        //     'user'=>$client,
        //     'intent' => $client->createSetupIntent(),
        //     'stripeKey' => config('cashier.key'),

        // ]);
    }

    public function processPayment(Request $request)
    {
        dump($request->all()) ;

        $payment  = \App\Models\OrderPayment::find($request->input('payment'));
        $paymentIntent = Cashier::stripe()->paymentIntents->retrieve( $payment->stripe_intent_id, ['expand' => ['payment_method']]);
        $paymentMethod = $request->input('stripepaymentMethod');
      
       
        
        try{
            //$client->charge($request->input('price')*100, $paymentMethod);
            $paymentIntent->confirm(['payment_method'=> $paymentMethod]);
            dump($paymentIntent) ;
        }catch (\Exception $e){
            return back()->withErrors(['message' =>  $e->getMessage()]);
        }
        $payment->status = 'succeeded' ;
        $payment->save() ;
        return back()->with(['success' =>  'bien']);
    }


}
