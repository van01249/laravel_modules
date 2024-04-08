<?php

namespace App\Providers;

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
                $sidebars = Auth::user()->roles()->where('id_parent', 0)->orderBy('id', 'ASC')->get();
                foreach ($sidebars as $key => $sidebar) {
                    $child = Auth::user()->roles()->where('id_parent', $sidebar->id)->where('show', 1)->orderBy('id', 'ASC')->get();
                    $sidebars[$key]['child'] = $child;
                }
                // dd($sidebars);
                $view->with('sidebars', $sidebars);
            }
        });
    }
}
