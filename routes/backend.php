<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Menu\MenuController;
use App\Http\Controllers\Backend\News\NewsController;
use App\Http\Controllers\Backend\Page\PageController;
use App\Http\Controllers\Backend\Poll\PollController;
use App\Http\Controllers\Backend\Tags\TagsController;
use App\Http\Controllers\Backend\Slide\SliderController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\TinyMCE\FileManagerController;
use App\Http\Controllers\Backend\Menu\MenuItem\MenuItemController;
use App\Http\Controllers\Backend\Poll\PollItem\PollItemController;
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
    ///////////////////// Tags End ////////////////////////

    ///////////////////// News Start //////////////////////
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('admin.news.index')->middleware('permission:admin.news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('admin.news.create')->middleware('permission:admin.news.create');
        Route::get('show/{id}', [NewsController::class, 'show'])->name('admin.news.show');
        Route::get('show/{id}/backup', [NewsController::class, 'showBackup'])->name('admin.news.show.backup');
        Route::get('/make/backup/{id}', [NewsController::class, 'makeBackup'])->name('admin.news.make.backup');
        Route::post('/store', [NewsController::class, 'store'])->name('admin.news.store')->middleware('permission:admin.news.create');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit')->middleware('permission:admin.news.edit');
        Route::post('/update/{id}', [NewsController::class, 'update'])->name('admin.news.update')->middleware('permission:admin.news.edit');
        Route::post('/delete/{id}', [NewsController::class, 'delete'])->name('admin.news.delete')->middleware('permission:admin.news.delete');
        Route::post('/status/{id}', [NewsController::class, 'status'])->name('admin.news.status');
        Route::post('/status/comment/{id}', [NewsController::class, 'statusComment'])->name('admin.news.status.comment');
        Route::get('/{id}/comments', [NewsController::class, 'comments'])->name('admin.news.comments');
        Route::post('{newsId}/comment/status/{id}', [NewsController::class, 'commentStatusUpdate'])->name('admin.news.comment.status');
        Route::post('{newsId}/comment/delete/{commentId}', [NewsController::class, 'commentDelete'])->name('admin.news.comment.delete');
        // Route::post('/file-manager/{type}/{folderId}', [FileManagerController::class, 'index'])->name('admin.file-manager.index');
    });
    ///////////////////// News End //////////////////////

    ///////////////////// Poll Start //////////////////////
    Route::prefix('poll')->group(function () {
        Route::get('/', [PollController::class, 'index'])->name('admin.poll.index')->middleware('permission:admin.poll.index');
        Route::get('/create', [PollController::class, 'create'])->name('admin.poll.create')->middleware('permission:admin.poll.create');
        Route::post('/store', [PollController::class, 'store'])->name('admin.poll.store')->middleware('permission:admin.poll.create');
        Route::get('/edit/{id}', [PollController::class, 'edit'])->name('admin.poll.edit')->middleware('permission:admin.poll.edit');
        Route::post('/update/{id}', [PollController::class, 'update'])->name('admin.poll.update')->middleware('permission:admin.poll.edit');
        Route::post('/delete/{id}', [PollController::class, 'delete'])->name('admin.poll.delete')->middleware('permission:admin.poll.delete');
        Route::get('/result/{id}', [PollController::class, 'result'])->name('admin.poll.result')->middleware('permission:admin.poll.result.index');
        Route::post('/response/delete/{id}', [PollController::class, 'responseDelete'])->name('admin.poll.response.delete')->middleware('permission:admin.poll.result.delete');

        ///////////////////// Poll Item Start //////////////////////
        Route::prefix('item')->group(function () {
            Route::get('/{id}', [PollItemController::class, 'index'])->name('admin.poll.item.index')->middleware('permission:admin.poll.item.index');
            Route::get('/create/{id}', [PollItemController::class, 'create'])->name('admin.poll.item.create')->middleware('permission:admin.poll.item.create');
            Route::post('/store/{id}', [PollItemController::class, 'store'])->name('admin.poll.item.store')->middleware('permission:admin.poll.item.create');
            Route::get('/edit/{id}', [PollItemController::class, 'edit'])->name('admin.poll.item.edit')->middleware('permission:admin.poll.item.edit');
            Route::post('/update/{id}', [PollItemController::class, 'update'])->name('admin.poll.item.update')->middleware('permission:admin.poll.item.edit');
            Route::post('/delete/{id}', [PollItemController::class, 'delete'])->name('admin.poll.item.delete')->middleware('permission:admin.poll.item.delete');
        });
        ///////////////////// Poll Item End //////////////////////

    });
    ///////////////////// Poll End //////////////////////

    ///////////////////// Menu Start //////////////////////
    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index')->middleware('permission:admin.menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create')->middleware('permission:admin.menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menu.store')->middleware('permission:admin.menu.create');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit')->middleware('permission:admin.menu.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update')->middleware('permission:admin.menu.edit');
        Route::post('/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete')->middleware('permission:admin.menu.delete');

        ///////////////////// Menu Item Start //////////////////////
        Route::prefix('item')->group(function () {
            Route::get('/{id}', [MenuItemController::class, 'index'])->name('admin.menu.item.index')->middleware('permission:admin.menu.item.index');
            Route::get('/create/{id}', [MenuItemController::class, 'create'])->name('admin.menu.item.create')->middleware('permission:admin.menu.item.create');
            Route::post('/store/{id}', [MenuItemController::class, 'store'])->name('admin.menu.item.store')->middleware('permission:admin.menu.item.create');
            Route::get('/edit/{id}', [MenuItemController::class, 'edit'])->name('admin.menu.item.edit')->middleware('permission:admin.menu.item.edit');
            Route::post('/update/{id}', [MenuItemController::class, 'update'])->name('admin.menu.item.update')->middleware('permission:admin.menu.item.edit');
            Route::post('/delete/{id}', [MenuItemController::class, 'delete'])->name('admin.menu.item.delete')->middleware('permission:admin.menu.item.delete');
        });
        ///////////////////// Menu Item End //////////////////////
    });
    ///////////////////// Menu End //////////////////////

    ///////////////////// Page Start //////////////////////
    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('admin.page.index')->middleware('permission:admin.page.index');
        Route::get('/create', [PageController::class, 'create'])->name('admin.page.create')->middleware('permission:admin.page.create');
        Route::post('/store', [PageController::class, 'store'])->name('admin.page.store')->middleware('permission:admin.page.create');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('admin.page.edit')->middleware('permission:admin.page.edit');
        Route::post('/update/{id}', [PageController::class, 'update'])->name('admin.page.update')->middleware('permission:admin.page.edit');
        Route::post('/delete/{id}', [PageController::class, 'delete'])->name('admin.page.delete')->middleware('permission:admin.page.delete');
        Route::get('/show/{id}', [PageController::class, 'show'])->name('admin.page.show');
    });
    ///////////////////// Page End //////////////////////


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
