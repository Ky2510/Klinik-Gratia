<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Treatment; // Pastikan model Treatment sudah ada

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Treatment::create([
                'name' => $faker->name, 
                'description' => $faker->text,
            ]);
        }
    }
}
