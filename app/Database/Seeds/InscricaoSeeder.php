<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Database\Factories\InscricaoFactory;

class InscricaoSeeder extends Seeder
{
    public function run()
    {
        for($i = 0;$i <= 100; $i++) {
            InscricaoFactory::create();
        }
    }
}
