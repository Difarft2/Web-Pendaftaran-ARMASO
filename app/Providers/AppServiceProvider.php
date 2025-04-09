<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\settingwebs;

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

        // Cek apakah tabel settingwebs sudah ada
        if (Schema::hasTable('settingwebs')) {
            // Menampilkan data settingweb di semua halaman
            view()->composer('*', function ($view) {
                $settingweb = Settingwebs::first(); // Ambil data pertama
                $view->with('settingweb', $settingweb);
            });

            // Menampilkan data settingweb di semua halaman
            $setting = Settingwebs::first();
            view()->share('settingweb', $setting);
            view()->share('single_settingweb', $setting->nama_website ?? '');
        }
    }
}
