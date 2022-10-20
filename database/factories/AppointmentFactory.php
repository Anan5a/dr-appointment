<?php

namespace Database\Factories;

use App\Models\Schedule;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'schedule_id'=>Schedule::inRandomOrder()->first(),
            'notes'=>fake()->text(),
        ];
    }
}
