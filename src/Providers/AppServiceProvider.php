<?php

namespace Sudip\LangMaker\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/lang-maker.php', 'lang-maker'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lang-maker');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'lang-maker');

        $this->publishes([
            __DIR__ . '/../../config/lang-maker.php' => config_path('lang-maker.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/lang-maker'),
        ], 'lang');
    }
}
