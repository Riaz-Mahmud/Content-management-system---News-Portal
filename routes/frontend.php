<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Frontend\Search\SearchController;
use App\Http\Controllers\Frontend\Subscribe\SubscribeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
////////////////// frontend routes start here //////////////////////
Route::middleware('front')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //////////////////////// Search Start ////////////////////////
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    //////////////////////// Search End ////////////////////////


    //////////////////////// subscribe Start ////////////////////////
    Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');
    //////////////////////// subscribe End ////////////////////////

});
