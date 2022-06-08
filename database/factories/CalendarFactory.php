<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'          => Carbon::today()->subDays(rand(0, 365)),
            'clients_id'    => mt_rand(1,6),
            'projects_id'    => mt_rand(1,6),
            'hours'         => mt_rand(1,10)
        ];
    }
}
