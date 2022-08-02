<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.profile.index', [
            'title' => __('My profile'),
        ]);
    }

    public function orders()
    {
        return view('client.profile.orders', [
            'title' => __('My Orders'),
        ]);
    }

    public function settings()
    {
        return view('client.profile.settings', [
            'title' => __('My Settings'),
        ]);
    }

    public function security()
    {
        return view('client.profile.security', [
            'title' => __('Security'),
        ]);
    }
}
