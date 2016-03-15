<?php

namespace Panic\Payments;


use Illuminate\Support\ServiceProvider;


class PaymentsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        // $this->handleMigrations();
        // $this->handleViews();
        // $this->handleTranslations();
        // $this->handleRoutes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind('payments', function ($app){
            return new Payments;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }
    private function handleConfigs() {
        $configPath = __DIR__ . '/../config/payments.php';
        $this->publishes([$configPath => config_path('payments.php')]);
        $this->mergeConfigFrom($configPath, 'payments');
    }
    private function handleTranslations() {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'payments');
    }
    private function handleViews() {
        $this->loadViewsFrom(__DIR__.'/../views', 'payments');
        $this->publishes([__DIR__.'/../views' => base_path('resources/views/panic/payments')]);
    }
    private function handleMigrations() {
        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
    }
    private function handleRoutes() {
        include __DIR__.'/../routes.php';
    }
}