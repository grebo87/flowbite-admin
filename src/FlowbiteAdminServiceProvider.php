<?php

namespace Grebo87\FlowbiteAdmin;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FlowbiteAdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/flowbite-admin.php',
            'flowbite-admin'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'flowbite-admin');

        // Register Blade components
        $this->registerComponents();

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);

            // Publishable assets
            $this->publishes([
                __DIR__ . '/../config/flowbite-admin.php' => config_path('flowbite-admin.php'),
            ], 'flowbite-admin-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/flowbite-admin'),
            ], 'flowbite-admin-views');
        }
    }

    protected function registerComponents()
    {
        Blade::componentNamespace('Grebo87\\FlowbiteAdmin\\View\\Components', 'flowbite-admin');

        // Anonymous components
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components', 'flowbite-admin');
    }
}

