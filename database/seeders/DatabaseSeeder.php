<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'amin',
            'email' => 'amin@gmail.com',
            'password' => Hash::make('carisaya@2024')
        ]);
        \App\Models\User::create([
            'username' => 'abu',
            'email' => 'abu@gmail.com',
            'password' => Hash::make('carisaya@2024')
        ]);
        \App\Models\User::create([
            'username' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('carisaya@2024')
        ]);
    }
}
