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
    | Comments Settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify the settings for the comments.
    | You can enable or disable the comments.
    | You can also specify the message and attachment enable or disable.
    |
    */
    'comment' => [
        'canComment' => true,
        'messageBox' => true,
        'attachment' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ads Settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify the settings for the ads.
    | You can enable or disable the ads.
    |
    */
    'ads' => [
        'show' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify the settings for the social media.
    |
    */
    'socialForUserAdd' => [
        [
            'type' => 'Facebook',
            'icon' => 'fab fa-facebook-f',
            'link' => 'https://www.facebook.com/',
        ],
        [
            'type' => 'Twitter',
            'icon' => 'fab fa-twitter',
            'link' => 'https://twitter.com/',
        ],
        [
            'type' => 'LinkedIn',
            'icon' => 'fab fa-linkedin-in',
            'link' => 'https://www.linkedin.com/in/',
        ],
        [
            'type' => 'Instagram',
            'icon' => 'fab fa-instagram',
            'link' => 'https://www.instagram.com/',
        ],
        [
            'type' => 'Behance',
            'icon' => 'fab fa-behance',
            'link' => 'https://www.behance.net/',
        ],
        [
            'type' => 'Skype',
            'icon' => 'fab fa-skype',
            'link' => 'skype:',
        ],
        [
            'type' => 'WhatsApp',
            'icon' => 'fab fa-whatsapp',
            'link' => 'https://api.whatsapp.com/send?phone=',
        ]
    ],

];
