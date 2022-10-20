<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentData>
 */
class AppointmentDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'appointment_id'=>Appointment::inRandomOrder()->first(),
            'type'=>fake()->randomElement(['file','text','video','pdf','doc']),
            'content'=>fake()->randomElement(['Example random data 1', 'Example random data 2','Example random data 3'])
        ];
    }
}
