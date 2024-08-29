<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Treatment;
use Illuminate\Support\Str;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $userIds = User::pluck('id')->toArray();
        $doctorIds = Doctor::pluck('id')->toArray();
        $treatmentIds = Treatment::pluck('id')->toArray();

        foreach (range(1, 20) as $index) {
            Appointment::create([
                'id' => (string) Str::uuid(),
                'user_id' => $faker->randomElement($userIds),
                'doctor_id' => $faker->randomElement($doctorIds),
                'treatment_id' => $faker->randomElement($treatmentIds),
                'appointment_date' => $faker->dateTimeBetween('now', '+1 year'),
            ]);
        }
    }
}
