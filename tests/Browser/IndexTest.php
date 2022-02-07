<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\IndexPage;
use Tests\DuskTestCase;
use Throwable;

class IndexTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test an unauthenticated user can see index.
     *
     * @return void
     * @test
     * @throws Throwable
     */
    public function test_index_is_viewable()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new IndexPage())
                ->assertSee('Welcome to Madhouse Miners!');
        });
    }
}
