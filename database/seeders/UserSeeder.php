<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pos.com',
            'phone' => '0812313444',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Membuat Akun Kasir Default
        User::create([
            'name' => 'Cashier',
            'email' => 'kasir@pos.com',
            'phone' => '0815155090800',
            'role' => 'cashier',
            'password' => Hash::make('password'),
        ]);
    }
}
