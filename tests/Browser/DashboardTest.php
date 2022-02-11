<?php

namespace Tests\Browser;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\DashboardPage;
use Tests\DuskTestCase;
use Throwable;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test to check if an admin can view the dashboard..
     *
     * @return void
     * @throws Throwable
     */
    public function test_we_can_see_dashboard()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create()->first();
            Admin::factory(['user_id' => $user->id])->create();
            $browser->loginAs($user)->visit(new DashboardPage())
                ->assertSee('Dashboard')
                ->assertSee('Users')
                ->assertSee('Nodes')
                ->assertSee('Servers')
                ->assertSee('Games')
                ->assertSee($user->name)
                ->assertSee('View profile')
                ->assertSee('Hello');
        });
    }
}
