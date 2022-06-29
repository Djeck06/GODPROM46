<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;


class StripeController extends Controller
{
    public function charge(Order $order){
        $client = Auth::user()->client;

        $payment =$client->payWith(
            $order->total * 100, ['card', 'bancontact']
        );
        // return $payment->client_secret;
        $paymentIntent = Arr::only($payment->asStripePaymentIntent()->toArray(), [
            'id', 'status', 'payment_method_types', 'client_secret', 'payment_method',
        ]);

        $paymentIntent['payment_method'] = Arr::only($paymentIntent['payment_method'] ?? [], 'id');

        return view('payment', [
            'stripeKey' => config('cashier.key'),
            'amount' => $payment->amount() ,
            'payment' => $payment,
            'paymentIntent' => array_filter($paymentIntent),
            'paymentMethod' => (string) request('source_type', optional($payment->payment_method)->type),
            'errorMessage' => request('redirect_status') === 'failed'
                ? 'Something went wrong when trying to confirm the payment. Please try again.'
                : '',
            'customer' => $payment->customer(),
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
        
        $client = Auth::user()->client;
        $paymentMethod = $request->input('payment_method');
        $client->createOrGetStripeCustomer();
        $client->addPaymentMethod($paymentMethod);
        try{
            $client->charge($request->input('price')*100, $paymentMethod);
        }catch (\Exception $e){
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect()->route('profile.orders');
    }


}
