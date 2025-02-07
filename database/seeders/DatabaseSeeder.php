<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criação dos usuários básicos
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
                'is_admin' => true
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@demo.com'],
            [
                'name' => 'User',
                'password' => Hash::make('1234'),
                'is_admin' => false
            ]
        );

        // Criação dos autores
        $faker = Faker::create('pt_BR');
        
        for ($i = 0; $i < 10; $i++) {
            Author::create([
                'nome' => $faker->name,
                'ativo' => $i < 7 // 7 ativos e 3 inativos
            ]);
        }
    }
}
