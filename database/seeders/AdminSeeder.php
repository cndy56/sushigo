<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name'     => 'Admin SushiGo',
            'email'    => 'admin@sushigo.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // Buat akun user biasa untuk testing
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'user@sushigo.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);
    }
}