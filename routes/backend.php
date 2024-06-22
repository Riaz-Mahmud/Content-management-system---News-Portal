<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Profile\ProfileController;


Route::prefix('admin')->middleware(['auth','userRolePermission:admin.dashboard.index'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    ///////////////////// Profile Start //////////////////////
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::get('/{email}/security', [ProfileController::class, 'security'])->name('admin.profile.security');
        Route::get('/{email}/article', [ProfileController::class, 'article'])->name('admin.profile.article.show');
        Route::get('/{email}', [ProfileController::class, 'show'])->name('admin.profile.show');
        Route::post('/update/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.profile.updatePassword');
    });
    ///////////////////// Profile End //////////////////////

});
