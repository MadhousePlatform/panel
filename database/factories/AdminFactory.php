<?php

namespace Database\Factories;

use App\Enums\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['user_id' => "mixed", 'role' => "\App\Enums\Admin"])]
    public function definition(): array
    {
        return [
            'user_id' => (new User)->first()->id,
            'role' => Admin::Root,
        ];
    }
}
