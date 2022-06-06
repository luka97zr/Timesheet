<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $suffix = [
            'Media Monks',
            'Emakina',
            'Bright Marbles',
            'TeachFirst',
            'Broadcast Media',
            'Tink',
            'Bank of Cyprus'
        ];
        return [
            'name'  => Arr::random($suffix)
        ];
    }
}
