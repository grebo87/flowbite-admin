<?php

namespace Grebo87\FlowbiteAdmin\Tests;

use Grebo87\FlowbiteAdmin\FlowbiteAdminServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mock Vite to avoid manifest not found errors during view rendering tests
        \Illuminate\Support\Facades\Vite::spy();
    }

    protected function getPackageProviders($app): array
    {
        return [
            FlowbiteAdminServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.key', 'base64:' . base64_encode(random_bytes(32)));
    }
}
