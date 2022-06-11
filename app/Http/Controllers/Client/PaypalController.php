<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Paypa

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PaypalController extends Controller
{
    public function __construct()
    {
        //Paypal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(
            new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret']
            )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function handlePayment($order)
    {
        

    }

    public function captureOrder()
    {
        
    }
}
