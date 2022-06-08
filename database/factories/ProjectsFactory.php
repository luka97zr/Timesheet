<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arr = [
            'Software Development',
            'Testing',
            'Intern',
            'Meeting with clients',
            'Learning',
            'Drupal',
            'WP'
        ];
        return [
            'name'  => $this->faker->unique()->name()
        ];
    }
}
