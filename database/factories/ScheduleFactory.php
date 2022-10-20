<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fkd = fake()->dateTimeThisMonth();
        $fkd2 = clone $fkd;
        return [
            'user_id'=>User::role('doctor')->inRandomOrder()->first(),
            'from'=>$fkd,
            'to'=>$fkd2->modify('+30 minutes'),
        ];
    }
}
