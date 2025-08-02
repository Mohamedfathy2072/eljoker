<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            [
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'password' => Hash::make('123456879'),
            ]
        );

        User::firstOrCreate(
            [
                'email' => 'user@example.com',
                'name' => 'User User',
                'phone' => '01125833982',
                'is_active' => true
            ]
        );

        $this->call([
            LookupSeeder::class,
            CarSeeder::class,
        ]);
    }
}
