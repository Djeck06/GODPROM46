<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function charge(Order $order){
        $client = Auth::user()->client;

        return view('client.order.payment', [
            'title' => __('Payment Verification #') . $order->reference,
            'order' => $order,
            'user'=>$client,
            'intent' => $client->createSetupIntent(),
            'stripeKey' => config('cashier.key'),

        ]);
    }

    public function processPayment(Request $request, String $product, $price)
    {
        dd($request->input('payment_method')) ;
        $client = Auth::user()->client;
        $paymentMethod = $request->input('payment_method');
        $client->createOrGetStripeCustomer();
        $client->addPaymentMethod($paymentMethod);
        try{
            $client->charge($price*100, $paymentMethod);
        }catch (\Exception $e){
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect('home');
    }


}
