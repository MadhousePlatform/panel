<?php

namespace Tests\Feature;

use Tests\TestCase;

class DiscordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_we_get_redirected_to_discord()
    {
        $response = $this->get(route('discord'));

        $response->assertStatus(302);
    }
}
