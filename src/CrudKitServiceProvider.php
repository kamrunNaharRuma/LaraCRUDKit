<?php

namespace Ruma\CrudKit;

use Illuminate\Support\ServiceProvider;


class CrudKitServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('crud-kit', function ($app) {
            return new CrudKit();
        });


    }

    public function boot()
    {

    }
}