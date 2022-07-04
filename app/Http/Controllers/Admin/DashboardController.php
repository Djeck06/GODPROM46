<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        return view('admin.dashboard');
    }

    public function commands ($status = null)
    {
        $title = __('Gestions des commandes') ;
        if(is_null($status)){
            return view('admin.commands', [
                'title' =>$title,
            ]) ;
        }else{
            if($status == 'pending'){ $secondtitle = __('Commandes en attente de payement') ;}
            if($status == 'readytopickup'){ $secondtitle = __("Commandes pretes pour l'enlèvement") ;}

            return view('admin.commands', [
                'title' => $title,
                'secondtitle' => $secondtitle ,
                'etat' => $status,
            ]);
        }
    }

    public function commandassigns()
    {
        return view('admin.commands', [
            'title' => __('Gestions des assignements'),
        ]);
    }

    public function docks()
    {
        return view('admin.commands', [
            'title' => __('Gestions des quais'),
        ]);
    }

    public function boxes()
    {
        return view('admin.boxes', [
            'title' => __('Gestions des contenaires'),
        ]);
    }

    public function carriers()
    {
        return view('admin.carriers', [
            'title' => __('Gestions des transporteurs'),
        ]);
    }

    public function customers()
    {
        return view('admin.clients', [
            'title' => __('Gestions des Clients'),
        ]);
    }


    public function fencing()
    {
        return view('admin.fencings', [
            'title' => __('Gestions des clotures'),
        ]);
    }
}
