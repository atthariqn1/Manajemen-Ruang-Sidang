<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Administrator untuk Demo Tugas & Video
        User::updateOrCreate(
            ['email' => 'admin@sidang.ac.id'],
            [
                'name' => 'Administrator Sidang',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
