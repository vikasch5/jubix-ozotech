<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ozotech@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('ozotech@admin@2025'),
                'email_verified_at' => now(),
            ]
        );
    }
}
