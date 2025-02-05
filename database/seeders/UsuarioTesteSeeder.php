<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('1234'),
                'is_admin' => true
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@demo.com'],
            [
                'name' => 'Normal User',
                'password' => Hash::make('1234'),
                'is_admin' => false
            ]
        );
    }
}
