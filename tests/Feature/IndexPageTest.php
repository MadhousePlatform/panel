<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test an unauthenticated user can see index.
     *
     * @return void
     * @test
     */
    public function test_index_is_viewable()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test that the index page redirects if you are authenticated.
     *
     * @return void
     * @test
     */
    public function test_index_is_not_viewable_when_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->get(route('index'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test that the index page redirects if you are authenticated.
     *
     * @return void
     * @test
     */
    public function test_index_redirects_to_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('index'));

        $response
            ->assertRedirectContains('/')
            ->assertStatus(Response::HTTP_OK);
    }
}
