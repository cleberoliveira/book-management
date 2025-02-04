<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR'); // Configurando Faker para português do Brasil

        // Cria 10 autores com nomes aleatórios em português
        for ($i = 0; $i < 10; $i++) {
            Author::create([
                'nome' => $faker->name,
                'estado' => 'ativo', // Estado padrão para todos os autores
            ]);
        }
    }
}