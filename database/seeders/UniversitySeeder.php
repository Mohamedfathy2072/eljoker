<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
  
    public function run(): void
    {
        $file = fopen(database_path('data/universities.csv'), 'r');
        fgetcsv($file);

        while ($row = fgetcsv($file)) {
            University::updateOrCreate([
                'name' => $row[0],

            ]);
        }

        fclose($file);
    }
}
