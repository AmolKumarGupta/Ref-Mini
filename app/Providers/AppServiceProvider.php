<?php

namespace App\Providers;

use App\Helper;
use Illuminate\Support\Facades\Blade;
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
        $this->app->singleton('helpers', function($app) {
            return new Helper(config('helpers'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('github', function () {
            return "<?php echo auth()->user()->github_username ? auth()->user()->github_username : 'Github Username' ?>";
        });
    }
}
