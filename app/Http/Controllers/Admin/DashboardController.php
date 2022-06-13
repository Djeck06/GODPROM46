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

    public function commands()
    {
        return view('admin.commands', [
            'title' => __('Gestions des commandes'),
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
        return view('admin.customers', [
            'title' => __('Gestions des Clients'),
        ]);
    }
}
