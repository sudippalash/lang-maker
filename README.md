## lang-maker comes to Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


`lang-maker` is a simple file handling package of `Laravel` that provides variety of options to deal with languages.

## Install

Via Composer

```bash
composer require sudippalash/lang-maker
```

#### Publish config file

You will need to publish config file to add `lang-maker` global path.

```
php artisan vendor:publish --provider="Sudip\LangMaker\Providers\AppServiceProvider" --tag=lang-maker
```

In `config/lang-maker.php` config file you should set `lang-maker` global path.

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
        | Provide a route name for language route. Example: user.language
        | Provide a prefix name for language url. Example: user/language
        | If language route use any middleware then provide it or leave empty array. Example: ['auth ']
        */

        'route_name' => 'user.language',
        'route_prefix' => 'user/language',
        'middleware' => [],

        /*
        |--------------------------------------------------------------------------
        | Ignore Language File
        |--------------------------------------------------------------------------
        |
        | specify the file names (without extension) in array which you want to ignore to modify or leave it blank array
        */

        'ignore_lang_file' => [],   //['validation', 'pagination']

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
        ],
    ];
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sudippalash/lang-maker?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sudippalash/lang-maker?style=flat-square
[ico-license]: https://img.shields.io/github/license/sudippalash/lang-maker?style=flat-square
[link-packagist]: https://packagist.org/packages/sudippalash/lang-maker
[link-downloads]: https://packagist.org/packages/sudippalash/lang-maker
[link-author]: https://github.com/sudippalash
