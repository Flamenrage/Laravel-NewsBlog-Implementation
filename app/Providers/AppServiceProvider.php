<?php

namespace App\Providers;
use App\Models\Rubric;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        DB::listen(function($query){
         //   dump($query->sql); //sql запрос, иногда мешает регистрации
            Log::channel('sqllog')->info($query->sql); //сохранение в файл sqllog
        });
        Validator::extend('cyrillic', function($attribute, $value, $parameters, $validator) { return preg_match('/[А-Яа-яЁёA-Za-z]/u', $value); });
        view()->composer('layouts.footer', function ($view){
           $view->with('rubs', Rubric::all()); //['layouts,footer', 'layots.header'] и тд
        });
    }
}
