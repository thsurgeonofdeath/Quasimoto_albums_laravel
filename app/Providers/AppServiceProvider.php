<?php

namespace App\Providers;

use view;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        
        view()->composer('*', function ($view) {
            $check = 1;
            if(auth()->user() != null){
                    $check = auth()->user()->roles()->where('name', 'admin')->exists();
                if($check == false){
                    $check = auth()->user()->roles()->where('name', 'writer')->exists();
                }
            }


            return $view->with('checkadminwriter', $check);
        });
       
    }

}
