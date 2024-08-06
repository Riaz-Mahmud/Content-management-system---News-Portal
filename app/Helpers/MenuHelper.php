<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Auth;

class MenuHelper{

    public static function generateMenu(){

        $data = [];
        $data['menu'] = [];

        if(!Auth::check()){
            $data = json_encode($data);
            return $data;
        }
        if(Auth::user()->hasPermissionTo('admin.dashboard.index')){
            $data['menu'][] = [
                'name' => 'Dashboard',
                'icon' => 'menu-icon tf-icons bx bx-home',
                'slug' => 'dashboard',
                'url' => '/admin/dashboard',
            ];
        }

        if(Auth::user()->hasPermissionTo('admin.slide.index') || Auth::user()->hasPermissionTo('admin.slide.create')){
            $data['menu'][] = [
                'name' => 'Sliders',
                'icon' => 'menu-icon tf-icons bx bx-slider',
                'slug' => 'admin.slide',
            ];
            if(Auth::user()->hasPermissionTo('admin.slide.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/slide',
                    'name' => 'List',
                    'slug' => 'admin.slide.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.slide.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/slide/create',
                    'name' => 'Create',
                    'slug' => 'admin.slide.create'
                ];
            }
        }


        if(Auth::user()->hasPermissionTo('admin.category.index') || Auth::user()->hasPermissionTo('admin.category.create')){
            $data['menu'][] = [
                'name' => 'Category',
                'icon' => 'menu-icon tf-icons bx bx-category',
                'slug' => 'admin.category',
            ];
            if(Auth::user()->hasPermissionTo('admin.category.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/category',
                    'name' => 'List',
                    'slug' => 'admin.category.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.category.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/category/create',
                    'name' => 'Create',
                    'slug' => 'admin.category.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.tags.index') || Auth::user()->hasPermissionTo('admin.tags.create')){
            $data['menu'][] = [
                'name' => 'Tags',
                'icon' => 'menu-icon tf-icons bx bx-tag',
                'slug' => 'admin.tags',
            ];
            if(Auth::user()->hasPermissionTo('admin.tags.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/tags',
                    'name' => 'List',
                    'slug' => 'admin.tags.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.tags.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/tags/create',
                    'name' => 'Create',
                    'slug' => 'admin.tags.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.news.index') || Auth::user()->hasPermissionTo('admin.news.create')){
            $data['menu'][] = [
                'name' => 'Article',
                'icon' => 'menu-icon tf-icons bx bx-news',
                'slug' => 'admin.news',
            ];
            if(Auth::user()->hasPermissionTo('admin.news.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/news',
                    'name' => 'List',
                    'slug' => 'admin.news.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.news.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/news/create',
                    'name' => 'Create',
                    'slug' => 'admin.news.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.poll.index') || Auth::user()->hasPermissionTo('admin.poll.create')){
            $data['menu'][] = [
                'name' => 'Poll',
                'icon' => 'menu-icon tf-icons bx bx-poll',
                'slug' => 'admin.poll',
            ];
            if(Auth::user()->hasPermissionTo('admin.poll.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/poll',
                    'name' => 'List',
                    'slug' => 'admin.poll.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.poll.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/poll/create',
                    'name' => 'Create',
                    'slug' => 'admin.poll.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.menu.index') || Auth::user()->hasPermissionTo('admin.menu.create')){
            $data['menu'][] = [
                'name' => 'Menu',
                'icon' => 'menu-icon tf-icons bx bx-menu',
                'slug' => 'admin.menu',
            ];
            if(Auth::user()->hasPermissionTo('admin.menu.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/menu',
                    'name' => 'List',
                    'slug' => 'admin.menu.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.menu.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/menu/create',
                    'name' => 'Create',
                    'slug' => 'admin.menu.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.page.index') || Auth::user()->hasPermissionTo('admin.page.create')){
            $data['menu'][] = [
                'name' => 'Pages',
                'icon' => 'menu-icon tf-icons bx bx-detail',
                'slug' => 'admin.page',
            ];
            if(Auth::user()->hasPermissionTo('admin.page.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/page',
                    'name' => 'List',
                    'slug' => 'admin.page.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.page.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/page/create',
                    'name' => 'Create',
                    'slug' => 'admin.page.create'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.ad.index') || Auth::user()->hasPermissionTo('admin.ad.create')){
            $data['menu'][] = [
                'name' => 'AD',
                'icon' => 'menu-icon tf-icons bx bx-detail',
                'slug' => 'admin.ad',
            ];
            if(Auth::user()->hasPermissionTo('admin.ad.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/ad',
                    'name' => 'List',
                    'slug' => 'admin.ad.index'
                ];
            }
            if(Auth::user()->hasPermissionTo('admin.ad.create')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/ad/create',
                    'name' => 'Create',
                    'slug' => 'admin.ad.create'
                ];
            }
        }


        if(Auth::user()->hasPermissionTo('admin.user.index')){
            $data['menu'][] = [
                'name' => 'Users',
                'icon' => 'menu-icon tf-icons bx bx-user',
                'slug' => 'admin.user',
            ];

            if(Auth::user()->hasPermissionTo('admin.user.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/user',
                    'name' => 'List',
                    'slug' => 'admin.user.index'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.setting.index')){
            $data['menu'][] = [
                'name' => 'Setting',
                'icon' => 'menu-icon tf-icons bx bx-cog',
                'slug' => 'admin.setting',
            ];
            if(Auth::user()->hasPermissionTo('admin.setting.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/setting',
                    'name' => 'List',
                    'slug' => 'admin.setting.index'
                ];
            }
        }

        if(Auth::user()->hasPermissionTo('admin.role.index')){
            $data['menu'][] = [
                'name' => 'Roles & Permissions',
                'icon' => 'menu-icon tf-icons bx bx-check-shield',
                'slug' => 'admin.role',
            ];
            if(Auth::user()->hasPermissionTo('admin.role.index')){
                $data['menu'][count($data['menu'])-1]['submenu'][] = [
                    'url' => '/admin/role',
                    'name' => 'Roles',
                    'slug' => 'admin.role.index'
                ];
            }
        }


        return $data;

    }

}
