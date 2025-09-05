<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = \App\Models\Hospital::all();
        foreach ($hospitals as $hospital) {
            \App\Models\Patient::factory()->count(rand(5, 15))->create([
                'hospital_id' => $hospital->id,
            ]);
        }
    }
}
