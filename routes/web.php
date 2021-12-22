<?php

use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\QuotationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    require __DIR__ . '/admin.php';
});


Route::get('/', function () {
    return redirect()->route('home-locale', app()->getLocale());
})->name('home');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}']], function () {
    Route::get('/', [PageController::class, 'home'])->name('home-locale');
    Route::get('/how-it-works', [PageController::class, 'how'])->name('how');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});

Route::group(['middleware' => 'verified'], function () {
    Route::resource('quotation', QuotationController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__.'/auth.php';
