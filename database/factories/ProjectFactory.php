<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'client_id' => Client::factory(),
            'lead_id'  => Lead::factory()
        ];
    }
}
