<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Extends Layout Name
    |--------------------------------------------------------------------------
    |
    | Your main layout file path name. Example: layouts.app
    |
    */

    'layout_name' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Section Name
    |--------------------------------------------------------------------------
    |
    | Your section name which in yield in main layout file. Example: content
    |
    */

    'section_name' => 'content',

    /*
    |--------------------------------------------------------------------------
    | Route Name, Prefix & Middleware
    |--------------------------------------------------------------------------
    |
    | Provide a route name for language route. Example: user.languages
    | Provide a prefix name for language url. Example: user/languages
    | If language route use any middleware then provide it or leave empty array. Example: ['auth']
    */

    'route_name' => 'user.languages',
    'route_prefix' => 'user/languages',
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Ignore Language File
    |--------------------------------------------------------------------------
    |
    | specify the file names (without extension) in array which you want to ignore to modify
    | or leave it blank array
    */

    'ignore_lang_file' => ['validation'],

    /*
    |--------------------------------------------------------------------------
    | Bootstrap version
    |--------------------------------------------------------------------------
    |
    | Which bootstrap you use in your application. Example: 3 or 4 or 5
    |
    */

    'bootstrap_v' => 4,

    /*
    |--------------------------------------------------------------------------
    | Flash Messages
    |--------------------------------------------------------------------------
    |
    | After Save/Update flash message session key name
    |
    */

    'flash_success' => 'success',
    'flash_error' => 'error',

    /*
    |--------------------------------------------------------------------------
    | CSS
    |--------------------------------------------------------------------------
    |
    | Add your css class in this property if you want to change design.
    */

    'css' => [
        'container' => null,
        'card' => null,
        'input' => null,
        'btn' => null,
        'link' => null,
    ],
];
