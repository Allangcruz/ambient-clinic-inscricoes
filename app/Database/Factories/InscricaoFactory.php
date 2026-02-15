<?php

namespace App\Database\Factories;

use App\Models\InscricaoModel;
use Faker\Factory;

class InscricaoFactory
{
    public static function create(array $overrides = [])
    {
        $faker = Factory::create('pt_BR');

        $defaults = [
            'nome' => 'inscricao_' . bin2hex(random_bytes(4)),
            'email'    => $faker->unique()->safeEmail,
            'cpf' => '123.123.123-75',
            'perfil' => $faker->randomElement(['estudante', 'veterinario']),
            'telefone' => $faker->numerify('(##) 9####-####'),
        ];

        // Mescla os padrões com os dados que você passar
        $data = array_merge($defaults, $overrides);

        $inscricaoModel = new InscricaoModel();
        $inscricaoId = $inscricaoModel->insert($data);

        // Retorna o objeto completo após inserção
        return $inscricaoModel->find($inscricaoId);
    }
}