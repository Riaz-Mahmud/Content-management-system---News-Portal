<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Tags\TagsController;
use App\Http\Controllers\Backend\Slide\SliderController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Slide\SlideItem\SlideItemController;


Route::prefix('admin')->middleware(['auth','userRolePermission:admin.dashboard.index'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    ///////////////////// Slide Start //////////////////////
    Route::prefix('slide')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.slide.index')->middleware('permission:admin.slide.index');
        Route::get('/create', [SliderController::class, 'create'])->name('admin.slide.create')->middleware('permission:admin.slide.create');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.slide.store')->middleware('permission:admin.slide.create');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('admin.slide.edit')->middleware('permission:admin.slide.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('admin.slide.update')->middleware('permission:admin.slide.edit');
        Route::post('/delete/{id}', [SliderController::class, 'delete'])->name('admin.slide.delete')->middleware('permission:admin.slide.delete');

        ///////////////////// Slide Item Start //////////////////////
        Route::prefix('item')->group(function () {
            Route::get('/{id}', [SlideItemController::class, 'index'])->name('admin.slide.item.index')->middleware('permission:admin.slide.item.index');
            Route::get('/create/{id}', [SlideItemController::class, 'create'])->name('admin.slide.item.create')->middleware('permission:admin.slide.item.create');
            Route::post('/store/{id}', [SlideItemController::class, 'store'])->name('admin.slide.item.store')->middleware('permission:admin.slide.item.create');
            Route::get('/edit/{id}', [SlideItemController::class, 'edit'])->name('admin.slide.item.edit')->middleware('permission:admin.slide.item.edit');
            Route::post('/update/{id}', [SlideItemController::class, 'update'])->name('admin.slide.item.update')->middleware('permission:admin.slide.item.edit');
            Route::post('/delete/{id}', [SlideItemController::class, 'delete'])->name('admin.slide.item.delete')->middleware('permission:admin.slide.item.delete');
        });
        ///////////////////// Slide Item End //////////////////////
    });
    ///////////////////// Slide End //////////////////////

    ///////////////////// Category Start //////////////////////
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index')->middleware('permission:admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware('permission:admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store')->middleware('permission:admin.category.create');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit')->middleware('permission:admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update')->middleware('permission:admin.category.edit');
        Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete')->middleware('permission:admin.category.delete');
    });
    ///////////////////// Category End //////////////////////

    ///////////////////// Tags Start //////////////////////
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagsController::class, 'index'])->name('admin.tags.index')->middleware('permission:admin.tags.index');
        Route::get('/create', [TagsController::class, 'create'])->name('admin.tags.create')->middleware('permission:admin.tags.create');
        Route::post('/store', [TagsController::class, 'store'])->name('admin.tags.store')->middleware('permission:admin.tags.create');
        Route::get('/edit/{id}', [TagsController::class, 'edit'])->name('admin.tags.edit')->middleware('permission:admin.tags.edit');
        Route::post('/update/{id}', [TagsController::class, 'update'])->name('admin.tags.update')->middleware('permission:admin.tags.edit');
        Route::post('/delete/{id}', [TagsController::class, 'delete'])->name('admin.tags.delete')->middleware('permission:admin.tags.delete');
    });
    ///////////////////// Tags End //////////////////////

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
