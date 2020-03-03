<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
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
        require_once app_path() . '/Helpers/helpers.php';

        $this->defineObservers();
    }


    /**
     * observers
     *
     * @return void
     */
    private function defineObservers(): void
    {
        User::observe(UserObserver::class);
    }
}
