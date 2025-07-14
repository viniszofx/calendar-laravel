<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@osiris.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('root123'),
            'is_admin' => true,
            'is_blocked' => false,
            'force_password_change' => false,
        ]);
    }
}
