<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'profile_image' => null,
            'birth_date' => '1990-01-01',
            'phone_number' => '1234567890',
            'address' => '123 Admin Street',
            'occupation' => 'Administrator',
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => Hash::make('guest123'),
            'profile_image' => null,
            'birth_date' => '1990-01-01',
            'phone_number' => '1234567890',
            'address' => '123 guest Street',
            'occupation' => 'Contributor',
        ]);
    }
}
