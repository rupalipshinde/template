<?php

namespace Rupalipshinde\Template;

use Illuminate\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider {

    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot() {

        $this->publishes([
            __DIR__ . '/config/template.php' => config_path('template.php'),
                ], 'template');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ]);
    }

    /**
     * Make config publishment optional by merging the config from the package.
     *
     * @return  void
     */
    public function register() {
        $this->mergeConfigFrom(
                __DIR__ . '/config/template.php', 'template'
        );
        
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }


}
