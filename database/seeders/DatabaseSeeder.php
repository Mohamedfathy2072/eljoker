<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->createUsers();
        $this->createAdmins();

        $this->call([
            LookupSeeder::class,
            CarSeeder::class,
            GovernorateSeeder::class,
            AreaSeeder::class,
            UniversitySeeder::class,
            FacultySeeder::class,
            QuizSeeder::class
        ]);
    }

    public function createUsers(): void
    {
        User::firstOrCreate(
            [
                'email' => 'user@example.com',
                'name' => 'User User',
                'phone' => '01125833982',
                'is_active' => true
            ]
        );
        // Instantiate Faker
        $faker = Faker::create();

        // Create 10 fake users
        foreach (range(1, 10) as $index) {
            User::firstOrCreate(
                [
                    'email' => $faker->unique()->safeEmail, // Generates a unique fake email
                    'name' => $faker->name, // Generates a random name
                    'phone' => $faker->numerify('0##########'), // Generates a fake phone number
                    'is_active' => $faker->boolean(80) // Randomly set 'is_active' to 80% of true
                ]
            );
        }
    }

    public function createAdmins(): void
    {
        Admin::firstOrCreate(
            [
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'password' => Hash::make('123456879'),
            ]
        );

        // Instantiate Faker
        $faker = Faker::create();

        // Create 5 fake admins
        foreach (range(1, 5) as $index) {
            Admin::firstOrCreate(
                [
                    'email' => $faker->unique()->safeEmail, // Generates a unique fake email
                    'name' => $faker->name, // Generates a random name
                    'password' => Hash::make('123456879'), // Password is always the same and hashed
                ]
            );
        }
    }
}
