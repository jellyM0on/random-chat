<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => 'Dummy User',
            'email' => 'dummy@example.com',
            'password' => 'password', // You can change this password
        ]);


        \App\Models\User::create([
            'name' => 'Dummy User2',
            'email' => 'dummy2@example.com',
            'password' => 'password', // You can change this password
        ]);

        
    }
}
