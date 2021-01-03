<?php
namespace Jjanampa\LaravelAdmin;

use Illuminate\Support\ServiceProvider as Provider;

final class ServiceProvider extends Provider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //Console
        $this->registerConsole();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Register the package console commands
     *
     * @return void
     */
    protected function registerConsole(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LaravelAdminCommand::class
            ]);
        }
    }

}
