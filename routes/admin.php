<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ParamsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::namespace('Auth')->group(function () {
  //Login routes
  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [LoginController::class, 'login']);
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

  Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
  Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

  // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
  // Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

  //Forgot Password Routes
  // Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
  // Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

  //Reset Password Routes
  // Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
  // Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
});

Route::middleware('auth:admin')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
  Route::get('/boxes', [DashboardController::class, 'boxes'])->name('boxes');
  Route::get('/carriers', [DashboardController::class, 'carriers'])->name('carriers');
  Route::get('/customers', [DashboardController::class, 'customers'])->name('customers');
  Route::get('/users', [DashboardController::class, 'users'])->name('users');

  Route::group(['prefix' => 'order', 'as' => 'orders.'], function () {
    Route::get('/', [DashboardController::class, 'commands'])->name('index');
    Route::get('/{status}', [DashboardController::class, 'commands'])->name('status');
    //Route::get('/{order:reference}/show', [OrderController::class, 'show'])->name('show');

  });

  Route::group(['prefix' => 'appointment', 'as' => 'appointments.'], function () {
    Route::get('/', [DashboardController::class, 'appointments'])->name('index');
    Route::get('/{status}', [DashboardController::class, 'appointments'])->name('status');
    //Route::get('/{order:reference}/show', [OrderController::class, 'show'])->name('show');
  });

  Route::group(['prefix' => 'docks', 'as' => 'docks.'], function () {
    Route::group(['prefix' => 'packagings', 'as' => 'packagings.'], function () {
      Route::get('/', [DashboardController::class, 'packagings'])->name('index');
      Route::get('/{status}', [DashboardController::class, 'packagings'])->name('status');
      //Route::get('/{order:reference}/show', [OrderController::class, 'show'])->name('show');
    });
    Route::group(['prefix' => 'deposits', 'as' => 'deposits.'], function () {
      Route::get('/', [DashboardController::class, 'deposits'])->name('index');
      Route::get('/{status}', [DashboardController::class, 'packagings'])->name('status');
      //Route::get('/{order:reference}/show', [OrderController::class, 'show'])->name('show');
    });
  });

  // Route::get('/command-assigns', [DashboardController::class, 'commandassigns'])->name('commandassigns');
  Route::get('/fencing', [DashboardController::class, 'fencing'])->name('fencing');


  Route::group(['prefix' => 'params', 'as' => 'params.'], function () {
    Route::get('/countries', [ParamsController::class, 'countries'])->name('countries');
    Route::get('/packages', [ParamsController::class, 'packages'])->name('packages');
    Route::get('/prices', [ParamsController::class, 'prices'])->name('prices');
    Route::get('/appoints', [ParamsController::class, 'appointments'])->name('appointments');

    
  });

  Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
  });


  
});