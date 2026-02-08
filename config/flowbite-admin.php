<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application displayed in the admin panel.
    |
    */
    'app_name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | The logo to display in the sidebar and navbar. Can be a URL or asset path.
    |
    */
    'logo' => 'https://flowbite.com/docs/images/logo.svg',

    /*
    |--------------------------------------------------------------------------
    | Sidebar Items
    |--------------------------------------------------------------------------
    |
    | Define the navigation items for the sidebar. Each item should have:
    | - label: Display text
    | - route: Route name (optional if using url)
    | - url: Direct URL (optional if using route)
    | - icon: Icon name (see available icons below)
    | - badge: Optional badge text
    | - badge_color: Badge color (blue, gray, red, green, yellow)
    |
    | Available icons: dashboard, kanban, inbox, users, products, signin, signup
    |
    */
    'sidebar' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'dashboard',
        ],
        [
            'label' => 'Users',
            'route' => 'users.index',
            'icon' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu Items
    |--------------------------------------------------------------------------
    |
    | Define the dropdown menu items for the user avatar menu.
    |
    */
    'user_menu' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'label' => 'Settings',
            'route' => 'profile.edit',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logout Route
    |--------------------------------------------------------------------------
    |
    | The route name for logout action.
    |
    */
    'logout_route' => 'logout',

    /*
    |--------------------------------------------------------------------------
    | User Avatar Attribute
    |--------------------------------------------------------------------------
    |
    | The attribute on the User model that contains the profile photo URL.
    | Default is 'profile_photo_url' (standard for Laravel Jetstream).
    |
    */
    'user_avatar_attribute' => 'profile_photo_url',
];
