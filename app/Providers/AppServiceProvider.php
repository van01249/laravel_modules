<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                if (Auth::user()->admin == 1) {
                    $sidebars = Role::all();
                    foreach ($sidebars as $key => $item) {
                        $sidebars[$key]['add'] = 1;
                    }
                } else {
                    $sidebars = Auth::user()->roles;
                    foreach ($sidebars as $key => $item) {
                        $sidebars[$key]['add'] = $item->pivot->add;
                    }
                }


                $view->with('sidebars', $sidebars)->with('user', $user);
            }
        });
    }
}
