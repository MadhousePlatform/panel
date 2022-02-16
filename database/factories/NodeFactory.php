<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Nordpeak\NamesGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Node>
 */
class NodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = NamesGenerator::generate(['delimiter' => ' ']);
        $port = mt_rand(14000, 14050);
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $name,
            'slug' => str()->slug($name),
            'description' => $this->faker->paragraph(),

            'location' => 'uk, lon',
            'ip_address' => $_SERVER['SERVER_ADDR'],
            'domain_name' => sprintf('%s.test', $this->faker->domainWord()),

            'file_dir' => storage_path('fake-server'),
            'total_memory' => 2048,
            'total_disk_space' => 2048,
            'daemon_port' => $port,
            'daemon_sftp_port' => $port + 100,

            'tags' => json_encode(['minecraft', 'server', 'macos', 'test']),
        ];
    }
}
