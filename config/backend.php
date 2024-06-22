<?php


return[

    /*
    |--------------------------------------------------------------------------
    | Site Settings
    |--------------------------------------------------------------------------
    | This is the site settings. You can change the site name, description, and
    | other settings here.
    |
    */
    'site' =>[
        'title' => 'News Portal',
        'keywords' => 'news portal, news, portal, news blog',
        'description' => 'News Portal is a news website that focuses on news-related news',
        'favicon' => 'assets/image/logo/logo.png',
        'author' => 'Abdul Al Mahmud Riaz',
        'logo' => 'assets/image/logo/logo_with_name.png',
    ],

    /*
    |--------------------------------------------------------------------------
    | Role Settings
    |--------------------------------------------------------------------------
    |
    | Here all the roles are defined. That will be used for assigning the roles to the users.
    | You can add more roles here. But make sure you add the same role in the database. Otherwise it will not work.
    | You can add the role in the database by running the command: php artisan db:seed --class=RoleTableSeeder
    */
    'role' => [
        'Super Admin',
        'Admin',
        'User',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permission Settings
    |--------------------------------------------------------------------------
    |
    | Here all the permissions are defined. That will be used for assigning the permissions to the roles.
    | You can add more permissions here. But make sure you add the same permission in the database. Otherwise it will not work.
    | You can add the permission in the database by running the command: php artisan db:seed --class=PermissionTableSeeder
    |
    */
    'permission' => [
        'Admin Dashboard' => [
            'show' => 'admin.dashboard.index',
        ],
        'Slide' => [
            'Show' => 'admin.slide.index',
            'Create' => 'admin.slide.create',
            'Update' => 'admin.slide.edit',
            'Delete' => 'admin.slide.delete',
        ],
        'Slide Item' => [
            'Show' => 'admin.slide.item.index',
            'Create' => 'admin.slide.item.create',
            'Update' => 'admin.slide.item.edit',
            'Delete' => 'admin.slide.item.delete',
        ],
        'Category' => [
            'Show' => 'admin.category.index',
            'Create' => 'admin.category.create',
            'Update' => 'admin.category.edit',
            'Delete' => 'admin.category.delete',
        ],
        'Tag' => [
            'Show' => 'admin.tags.index',
            'Create' => 'admin.tags.create',
            'Update' => 'admin.tags.edit',
            'Delete' => 'admin.tags.delete',
        ],
        'Content' => [
            'Show' => 'admin.news.index',
            'Create' => 'admin.news.create',
            'Update' => 'admin.news.edit',
            'Delete' => 'admin.news.delete',
        ],
        'Poll' => [
            'Show' => 'admin.poll.index',
            'Create' => 'admin.poll.create',
            'Update' => 'admin.poll.edit',
            'Delete' => 'admin.poll.delete',
        ],
        'Poll Options' => [
            'Show' => 'admin.poll.item.index',
            'Create' => 'admin.poll.item.create',
            'Update' => 'admin.poll.item.edit',
            'Delete' => 'admin.poll.item.delete',
        ],
        'Poll Result' => [
            'Show' => 'admin.poll.result.index',
            'Delete' => 'admin.poll.result.delete',
        ],
        'Menu' => [
            'Show' => 'admin.menu.index',
            'Create' => 'admin.menu.create',
            'Update' => 'admin.menu.edit',
            'Delete' => 'admin.menu.delete',
        ],
        'Menu Item' => [
            'Show' => 'admin.menu.item.index',
            'Create' => 'admin.menu.item.create',
            'Update' => 'admin.menu.item.edit',
            'Delete' => 'admin.menu.item.delete',
        ],
        'Page' => [
            'Show' => 'admin.page.index',
            'Create' => 'admin.page.create',
            'Update' => 'admin.page.edit',
            'Delete' => 'admin.page.delete',
        ],
        'Advertisement' => [
            'Show' => 'admin.ad.index',
            'Create' => 'admin.ad.create',
            'Update' => 'admin.ad.edit',
            'Delete' => 'admin.ad.delete',
        ],
        'User' => [
            'Show' => 'admin.user.index',
            'Delete' => 'admin.user.delete',
            'Assign Role' => 'admin.user.assign.role',
        ],
        'Settings' => [
            'Show' => 'admin.setting.index',
            'Update' => 'admin.setting.edit',
        ],
        'Role Permission' => [
            'Show' => 'admin.role.index',
            'Create' => 'admin.role.create',
            'Update' => 'admin.role.edit',
            'Delete' => 'admin.role.delete',
            'Assign Permission' => 'admin.role.assign.permission',
        ],
    ],

];
