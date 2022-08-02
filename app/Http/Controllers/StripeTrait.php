<?php

namespace App\Http\Controllers;


use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

Trait StripeTrait
{
    public function paymentItent(Model $client, Model $order){
        
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

        return ['payment' => $payment,'customer' => $stripeCustomer];
    }

}
