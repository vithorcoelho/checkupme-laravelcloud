<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agreement;

class AgreementSeeder extends Seeder
{
    public function run(): void
    {
        $agreements = [
            [
                'name' => 'Lutopax',
                'description' => 'Descrição do convênio 1',
                'status' => 1,
            ],
            [
                'name' => 'Caixa Saúde',
                'description' => 'Descrição do convênio 2',
                'status' => 1,
            ],
            [
                'name' => 'FioCruz',
                'description' => 'Descrição do convênio 3',
                'status' => 1,
            ],
            [
                'name' => 'Unimed',
                'description' => 'Descrição do convênio 4',
                'status' => 1,
            ],
            [
                'name' => 'SulAmérica',
                'description' => 'Descrição do convênio 5',
                'status' => 1,
            ],
            [
                'name' => 'Bradesco Saúde',
                'description' => 'Descrição do convênio 6',
                'status' => 1,
            ],
            [
                'name' => 'Amil',
                'description' => 'Descrição do convênio 7',
                'status' => 1,
            ],
            [
                'name' => 'Hapvida',
                'description' => 'Descrição do convênio 8',
                'status' => 1,
            ],
            [
                'name' => 'São Francisco',
                'description' => 'Descrição do convênio 9',
                'status' => 1,
            ],
            [
                'name' => 'São Lucas',
                'description' => 'Descrição do convênio 10',
                'status' => 1,
            ],
        ];

        foreach ($agreements as $agreement) {
            Agreement::create($agreement);
        }
    }
}
