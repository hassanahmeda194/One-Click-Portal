<?php

namespace App\Providers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
//        try {
//            DB::connection()->getPdo();
//        } catch (Exception $e) {
//            // Database connection failed, redirect to your custom route
//            Route::get('/Database-Connection-Error', static function () use ($e) {
//                return view('errors.database-connection')->with('message', $e->getMessage());
//            });
//            return redirect('/Database-Connection-Error');
//        }
//        return redirect()->route('Main.Dashboard');
    }
}
