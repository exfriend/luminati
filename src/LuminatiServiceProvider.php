<?php

namespace Exfriend\Luminati;

use Exfriend\Luminati\Commands\RefreshIps;
use Illuminate\Support\ServiceProvider;

class LuminatiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes( [ __DIR__ . '/config/luminati.php' => config_path( 'luminati.php' ), ] );
        $this->loadMigrationsFrom( __DIR__ . '/migrations' );

        if ( $this->app->runningInConsole() )
        {
            $this->commands( [
                RefreshIps::class,
            ] );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
