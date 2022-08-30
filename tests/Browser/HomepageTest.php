<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * Class HomepageTest
 * @package Tests\Browser
 */
class HomepageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @test
     * @return void
     * @throws \Throwable
     */
    public function it_should_see_laravel_on_homepage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Laravel');
        });
    }
}
