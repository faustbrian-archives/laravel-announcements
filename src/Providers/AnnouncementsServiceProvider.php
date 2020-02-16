<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Announcements.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Announcements\Providers;

use Illuminate\Support\ServiceProvider;

class AnnouncementsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/announcements.php', 'announcements');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

            $this->loadViewsFrom(__DIR__.'/../../resources/views', 'announcements');

            $this->publishes([
                __DIR__.'/../../config/announcements.php' => $this->app->configPath('announcements.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../database/migrations/' => $this->app->databasePath('migrations'),
            ], 'migrations');
        }

        $this->app->bind('kodekeep.announcements.converter', function ($app) {
            $converter = $app['config']->get('announcements.converter');

            return new $converter['adapter']($converter['config'], $converter['environment']);
        });
    }
}
