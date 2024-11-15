## lang-maker

![alt text](https://github.com/sudippalash/lang-maker/blob/master/img.jpg?raw=true)

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


`lang-maker` is a simple language handling package of `Laravel` that provides to create and modify your project's lang folder.

## Install

Via Composer

```bash
composer require sudippalash/lang-maker
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Sudip\LangMaker\Providers\AppServiceProvider" --tag=config
```

This is the contents of the published config file `config/lang-maker.php`:

```php
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
```

Optionally, you can publish the lang using

```bash
php artisan vendor:publish --provider="Sudip\LangMaker\Providers\AppServiceProvider" --tag=lang
```

## Usage

You should copy the below line and paste in your project menu section

```bash
<a href="{{ route(config('lang-maker.route_name')) }}">{{ trans('lang-maker::sp_lang_maker.language') }}</a>
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sudippalash/lang-maker?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sudippalash/lang-maker?style=flat-square
[ico-license]: https://img.shields.io/github/license/sudippalash/lang-maker?style=flat-square
[link-packagist]: https://packagist.org/packages/sudippalash/lang-maker
[link-downloads]: https://packagist.org/packages/sudippalash/lang-maker
[link-author]: https://github.com/sudippalash
