<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentData;
use App\Models\User;
use Database\Factories\AppointmentDataFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,100) as $r){
            Appointment::factory()
                ->count(1)
                ->for(User::inRandomOrder()->first())
                ->has(AppointmentData::factory(2))
                ->create();
        }
    }
}
