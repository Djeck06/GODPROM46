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
            if($status == 'paid'){ $secondtitle = __("Commandes payés") ;}
            if($status == 'packagingprocessing'){ $secondtitle = __("Commandes en conditionnement") ;}
            if($status == 'pickedup'){ $secondtitle = __("Commandes réceptionnée") ;}

            
            if($status == 'readytopickup'){ $secondtitle = __("Commandes pretes pour l'enlèvement") ;}

            return view('admin.commands', [
                'title' => $title,
                'secondtitle' => $secondtitle ,
                'etat' => $status,
            ]);
        }
    }

    public function packagings ($status = null)
    {
        $title = __('Conditionnement') ;
        if(is_null($status)){
            return view('admin.packagings', [
                'title' =>$title,
            ]) ;
        }else{
            if($status == 'pending'){ $secondtitle = __('Commandes en attente de conditionnement') ;}
           
            return view('admin.packagings', [
                'title' => $title,
                'secondtitle' => $secondtitle ,
                'etat' => $status,
            ]);
        }
    }


    public function deposits ($status = null)
    {
        $title = __('Colis à quai') ;
        if(is_null($status)){
            return view('admin.deposits', [
                'title' =>$title,
            ]) ;
        }else{
            if($status == 'pending'){ $secondtitle = __('Colis en attente') ;}
           
            return view('admin.deposits', [
                'title' => $title,
                'secondtitle' => $secondtitle ,
                'etat' => $status,
            ]);
        }
    }

    public function appointments ($status = null)
    {
        $title = __('Gestions des Rendez - vous') ;
        if(is_null($status)){
            return view('admin.appointments', [
                'title' =>$title,
            ]) ;
        }else{
            if($status == 'pending'){ $secondtitle = __('Rendez - vous en attente') ;}
            if($status == 'assigned'){ $secondtitle = __('Rendez - vous assigné') ;}
            if($status == 'honored'){ $secondtitle = __("Rendez - vous honnorés") ;}
            if($status == 'canceled'){ $secondtitle = __("Rendez - vous annulés") ;}

            return view('admin.appointments', [
                'title' => $title,
                'secondtitle' => $secondtitle ,
                'etat' => $status,
            ]);
        }
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
