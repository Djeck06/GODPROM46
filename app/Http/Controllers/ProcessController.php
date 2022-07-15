<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\ProcessTrait;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    use ProcessTrait; 

    public function next(Order $order)
    {
        //dd($order->lastStatus->label ) ;
     
        $next = $this->getNextStatus($order->lastStatus->label, $order ) ;
        if(array_key_exists('todisplay', $next) && $next['todisplay'] == true){
            $methodname = static::$methods[$next['nextactionname']] ;
            return $this->$methodname($order) ;
        }

        
    }

}
