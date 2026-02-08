<?php

namespace Grebo87\FlowbiteAdmin\Tests\Feature;

use Grebo87\FlowbiteAdmin\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_service_provider(): void
    {
        $this->assertTrue(
            $this->app->providerIsLoaded(\Grebo87\FlowbiteAdmin\FlowbiteAdminServiceProvider::class)
        );
    }

    /** @test */
    public function it_loads_the_config(): void
    {
        $this->assertNotNull(config('flowbite-admin'));
        $this->assertArrayHasKey('app_name', config('flowbite-admin'));
        $this->assertArrayHasKey('sidebar', config('flowbite-admin'));
    }

    /** @test */
    public function it_registers_the_views(): void
    {
        $this->assertTrue(
            view()->exists('flowbite-admin::layouts.app')
        );
    }

    /** @test */
    public function it_registers_the_install_command(): void
    {
        $this->assertTrue(
            $this->app->make('Illuminate\Contracts\Console\Kernel')
                ->all()['flowbite-admin:install'] !== null
        );
    }

    /** @test */
    public function the_layout_view_can_be_rendered(): void
    {
        $view = $this->view('flowbite-admin::layouts.app');

        $view->assertSee('html');
    }

    /** @test */
    public function the_navbar_component_exists(): void
    {
        $this->assertTrue(
            view()->exists('flowbite-admin::components.navbar')
        );
    }

    /** @test */
    public function the_sidebar_component_exists(): void
    {
        $this->assertTrue(
            view()->exists('flowbite-admin::components.sidebar')
        );
    }

    /** @test */
    public function the_card_component_exists(): void
    {
        $this->assertTrue(
            view()->exists('flowbite-admin::components.card')
        );
    }

    /** @test */
    public function the_table_component_exists(): void
    {
        $this->assertTrue(
            view()->exists('flowbite-admin::components.table')
        );
    }
}
