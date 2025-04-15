<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Settingwebs;

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
        if (Schema::hasTable('settingwebs')) { // Pastikan menggunakan huruf kecil untuk nama tabel
            // Menampilkan data settingweb di semua halaman menggunakan composer
            view()->composer('*', function ($view) {
                $settingweb = Settingwebs::first(); // Ambil data pertama
                $view->with('settingweb', $settingweb); // Kirim data ke semua view
            });
        }
    }
}
