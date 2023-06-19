<?php

namespace App\Providers;

use App\Faker\CategoriaProvider;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend(Generator::class, function (Generator $generator, $app) {
            $generator->addProvider(new CategoriaProvider($generator));

            return $generator;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
