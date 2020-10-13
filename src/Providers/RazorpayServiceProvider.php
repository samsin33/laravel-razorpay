<?php

namespace Samsin33\Razorpay\Providers;

use Illuminate\Support\Facades\Route;
use Samsin33\Razorpay\Razorpay;
use Samsin33\Razorpay\Logger;
use Razorpay\Util\LoggerInterface;

class RazorpayServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLogger();
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->bindLogger();
    }

    /**
     * Setup the configuration for Razorpay.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/razorpay.php', 'razorpay'
        );
    }

    /**
     * Bind the Razorpay logger interface to the Razorpay logger.
     *
     * @return void
     */
    protected function bindLogger()
    {
        $this->app->bind(LoggerInterface::class, function ($app) {
            return new Logger(
                $app->make('log')->channel(config('razorpay.logger'))
            );
        });
    }

    /**
     * Register the Razorpay logger.
     *
     * @return void
     */
    protected function registerLogger()
    {
        if (config('razorpay.logger')) {
            Razorpay::setLogger($this->app->make(LoggerInterface::class));
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        if (Razorpay::$registersRoutes) {
            Route::group([
                'prefix' => config('razorpay.path'),
                'namespace' => 'Laravel\Razorpay\Http\Controllers',
                'as' => 'razorpay.',
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
        }
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'razorpay');
    }

    /**
     * Register the package migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (Razorpay::$runsMigrations && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/razorpay.php' => $this->app->configPath('razorpay.php'),
            ], 'razorpay-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'razorpay-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/razorpay'),
            ], 'razorpay-views');
        }
    }
}