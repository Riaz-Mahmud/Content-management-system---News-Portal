<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Frontend\News\NewsController;
use App\Http\Controllers\Frontend\Page\PageController;
use App\Http\Controllers\Frontend\User\UserController;
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
    Route::get('/all-news', [NewsController::class, 'allNews'])->name('all-news');

    ///////////////// profile routes start here //////////////////////
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('profile');

        Route::get('/{email}/edit', [UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
        Route::post('/{email}/update', [UserController::class, 'update'])->name('profile.update')->middleware('auth');
        Route::get('/{email}/change-password', [UserController::class, 'changePassword'])->name('profile.change-password')->middleware('auth');
        Route::post('/{email}/update-password', [UserController::class, 'updatePassword'])->name('profile.update-password.store')->middleware('auth');
        Route::prefix('publication')->group(function () {
            Route::get('/', [UserController::class, 'publication'])->name('profile.publication')->middleware('auth');
            Route::post('/store', [UserController::class, 'publicationStore'])->name('profile.publication.store')->middleware('auth');
            Route::post('/delete/{id}', [UserController::class, 'publicationDelete'])->name('profile.publication.delete')->middleware('auth');
        });
        Route::prefix('social')->group(function () {
            Route::get('/', [UserController::class, 'social'])->name('profile.social')->middleware('auth');
            Route::post('/store', [UserController::class, 'socialStore'])->name('profile.social.store')->middleware('auth');
            Route::post('/delete/{id}', [UserController::class, 'socialDelete'])->name('profile.social.delete')->middleware('auth');
        });
        Route::get('/{email}', [UserController::class, 'show'])->name('profile.show');
    });
    ///////////////// profile routes end here //////////////////////

    ///////////////// News Start //////////////////////
    Route::prefix('content')->group(function () {
        Route::get('/', function () {return redirect()->route('home');});
        Route::get('/{slug}', [NewsController::class, 'index'])->name('news.index');
        Route::get('/new/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');
        Route::post('/new/store', [NewsController::class, 'store'])->name('news.store')->middleware('auth');

        //comment
        Route::post('/add-comment/{newsId}', [NewsController::class, 'storeComment'])->name('news.store.comment');
    });
    ///////////////// News End //////////////////////

    ///////////////// Category Start //////////////////////
    Route::prefix('category')->group(function () {
        Route::get('/', [NewsController::class, 'allCategory']);
        Route::get('/{slug}', [NewsController::class, 'singleParentCategory'])->where('slug', '.*');
    });
    ///////////////// Category End //////////////////////

    ///////////////// Tag Start //////////////////////
    Route::prefix('tag')->group(function () {
        Route::get('/', function () { return redirect()->route('home'); });
        Route::get('/{lable}', [NewsController::class, 'showNewsByTag'])->name('news.tag');
    });
    ///////////////// Tag End //////////////////////

    ///////////////// Page Start //////////////////////
    Route::prefix('pages')->group(function () {
        Route::get('/', function () { return redirect()->route('home'); });
        Route::get('/{slug}', [PageController::class, 'index'])->name('page.index');
    });
    ///////////////// Page End //////////////////////

    //////////////////////// Search Start ////////////////////////
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    //////////////////////// Search End ////////////////////////


    //////////////////////// subscribe Start ////////////////////////
    Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe');
    //////////////////////// subscribe End ////////////////////////

});
