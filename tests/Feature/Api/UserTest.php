<?php

namespace Tests\Feature\Api;

use App\Models\Admin;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A test to see that we can fetch a user from the API.
     *
     * @test
     * @return void
     */
    public function test_we_can_get_a_user(): void
    {
        $user = User::factory()->create();
        $user = User::whereUuid($user->uuid)->first();

        $response = $this->actingAs($user)->get(route('api.user.read', $user->getUuid()));

        $response->assertStatus(Response::HTTP_OK)
            ->assertSee($user->getName(), false)
            ->assertSee($user->getEmail())
            ->assertSee($user->getUuid());
    }

    /**
     * A test to see that we cannot fetch a non-existent user from the API.
     *
     * @test
     * @return void
     */
    public function test_we_cannot_get_an_invalid_user(): void
    {
        $user = User::factory()->create();
        $user = User::whereUuid($user->uuid)->first();

        $response = $this->actingAs($user)->get(route('api.user.read', $this->faker->uuid()));

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertSee('This user could not be found.');
    }

    /**
     * A test to see that we can update a user from the API.
     *
     * @return void
     */
    public function test_we_can_update_a_user(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->id])->create();
        $user = User::whereUuid($user->uuid)->with('admin')->first();

        $response = $this->actingAs($user)->put(route('api.user.update', $user->uuid), [
            'name' => 'Gooby McGoober',
            'email' => 'gooby@example.com',
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertSee(__('User has been updated.'));

        $this->assertEquals('Gooby McGoober', $user->fresh()->getName());
        $this->assertEquals('gooby@example.com', $user->fresh()->getEmail());
        $this->assertNotSame($user->getName(), $user->fresh()->getName());
        $this->assertNotSame($user->getEmail(), $user->fresh()->getEmail());
    }

    /**
     * A test to see that we cannot update a user with invalid details from the API.
     *
     * @return void
     */
    public function test_we_cannot_update_a_user_with_invalid_details(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->id])->create();
        $user = User::whereUuid($user->uuid)->with('admin')->first();

        $response = $this->actingAs($user)->putJson(route('api.user.update', $user->uuid), [
            'name' => 'gooby@example.com',
            'email' => 'Gooby McGoober',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertSee('validation.email');

        $this->assertNotEquals('Gooby McGoober', $user->fresh()->getName());
        $this->assertNotEquals('gooby@example.com', $user->fresh()->getEmail());
    }

    /**
     * A test to see that we can create a user from the API.
     *
     * @return void
     */
    public function test_we_can_create_a_user(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->id])->create();
        $user = User::whereUuid($user->uuid)->with('admin')->first();

        $response = $this->actingAs($user)->post(route('api.user.create'), [
            'uuid' => $this->faker->uuid,
            'name' => 'Gooby McGoober',
            'email' => 'gooby@example.com',
            'password' => 'strong_password',
            'password_confirmation' => 'strong_password'
        ]);

        $user = User::all()->last();

        $response->assertStatus(Response::HTTP_OK)
            ->assertSee(__('User has been created.'));

        $this->assertEquals('Gooby McGoober', $user->getName());
        $this->assertEquals('gooby@example.com', $user->getEmail());
    }

    /**
     * A test to see that we cannot create a user with invalid details from the API.
     *
     * @return void
     */
    public function test_we_cannot_create_a_user_with_invalid_details(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->id])->create();
        $user = User::whereUuid($user->uuid)->with('admin')->first();

        $ridiculous_password = bin2hex(openssl_random_pseudo_bytes(653));

        $response = $this->actingAs($user)->postJson(route('api.user.create'), [
            'name' => 'Gooby McGoober',
            'email' => 'gooby@example.com',
            'password' => $ridiculous_password,
            'password_confirmation' => $ridiculous_password
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertSee('validation.max.string');

        $this->assertNotEquals('Gooby McGoober', $user->fresh()->getName());
        $this->assertNotEquals('gooby@example.com', $user->fresh()->getEmail());
    }

    /**
     * A test to see that we can delete a user from the API.
     *
     * @test
     * @return void
     */
    public function test_we_can_delete_a_user(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->first()->id])->create();
        $user = User::whereUuid($user->uuid)->with('admin')->first();

        $delete_this_user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('api.user.delete', $delete_this_user->first()->getUuid()));

        $response->assertStatus(Response::HTTP_OK)
            ->assertDontSee(__('An error occurred deleting the user.'))
            ->assertSee(__('The user has been deleted.'));
    }

    /**
     * A test to see that we can delete an administrator user from the API.
     *
     * @test
     * @return void
     */
    public function test_we_can_delete_an_admin_user(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->first()->id])->create();
        $user = User::whereUuid($user->uuid)->first();

        $delete_this_user = User::factory()->create();
        Admin::factory(['user_id' => $delete_this_user->first()->id])->create();
        $delete_this_user = User::whereUuid($delete_this_user->first()->getUuid())->with('admin')->first();

        $response = $this->actingAs($user)->delete(route('api.user.delete', $delete_this_user->first()->getUuid()));

        $response->assertStatus(Response::HTTP_OK)
            ->assertDontSee(__('An error occurred deleting the user.'))
            ->assertSee(__('The user has been deleted.'));
    }

    /**
     * A test to see that we cannot delete an administrator user from the API because
     * we lack the proper role.
     *
     * @test
     * @return void
     */
    public function test_we_cant_delete_a_user_because_we_dont_have_the_permission(): void
    {
        $user = User::factory()->create();
        Admin::factory(['user_id' => $user->first()->id, 'role' => \App\Enums\Admin::Basic->value])->create();
        $user = User::whereUuid($user->uuid)->first();

        $delete_this_user = User::factory()->create();
        Admin::factory(['user_id' => $delete_this_user->first()->id])->create();
        $delete_this_user = User::whereUuid($delete_this_user->first()->getUuid())->with('admin')->first();

        $response = $this->actingAs($user)->deleteJson(route('api.user.delete', $delete_this_user->first()->getUuid()));

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertSee(__('You must be an Administrator to delete users.'))
            ->assertJson(['message' => __('You must be an Administrator to delete users.')]);
    }
}
