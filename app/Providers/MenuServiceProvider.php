<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
        // $verticalMenuData = json_decode($verticalMenuJson);
        // $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
        // $horizontalMenuData = json_decode($horizontalMenuJson);

        // $verticalMenuJson = MenuHelper::generateMenu();
        // $verticalMenuData = json_decode($verticalMenuJson);
        // $horizontalMenuJson = MenuHelper::generateMenu();
        // $horizontalMenuData = json_decode($horizontalMenuJson);

        // dd($verticalMenuData);


        // Share all menuData to all the views
        // View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
    }
}
