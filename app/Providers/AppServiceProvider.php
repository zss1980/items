<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton ('League\Glide\Server', function ($app) {

            $filesystem=$app->make('Illuminate\Contracts\Filesystem\Filesystem');

            return \League\Glide\ServerFactory::create ([
                'source'=>$filesystem->getDriver(),
                'cache'=>$filesystem->getDriver(),
                'source_path_prefix'=>'img',
                'cache_path_prefix'=> 'img/cache',
                'watermarks' =>$filesystem->getDriver(),
                'watermarks_path_prefix' =>'img',


                ]); 
        });
    }
}
