<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use MadhousePlatform\NamesGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => NamesGenerator::generate(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::first()->id,
            'ip_address' => '127.0.0.1',
            'port' => '9900',
            'additional_ports' => [],
            'memory' => 512,
            'disk' => 5000,
        ];
    }
}
