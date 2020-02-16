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

namespace KodeKeep\Announcements\Tests;

use Illuminate\Foundation\Auth\User;
use KodeKeep\Announcements\Providers\AnnouncementsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('announcements.models.author', User::class);
    }

    protected function getPackageProviders($app): array
    {
        return [AnnouncementsServiceProvider::class];
    }
}
