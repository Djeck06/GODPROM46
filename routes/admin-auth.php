<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
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