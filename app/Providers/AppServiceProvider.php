<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['src.component.owner.sidebar.sidebar', 'src.component.karyawan.sidebar.sidebar'], function ($view) {
            $dataProfile = Profile::where('user_id', Auth::user()->id)->first();

            // Mengirimkan data ke semua tampilan
            $view->with('dataProfile', $dataProfile);
        });
    }
}
