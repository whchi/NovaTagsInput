<?php

namespace Whchi\NovaTagsInput;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/nova_tags_input.php' => config_path('nova_tags_input.php'),
        ], 'config');

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-tags-input', __DIR__ . '/../dist/js/field.js');
            Nova::style('nova-tags-input', __DIR__ . '/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
