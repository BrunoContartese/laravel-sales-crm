<?php

namespace Database\Seeders;

use App\Models\Administration\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::create([
            'name' => 'CUIT',
            'code' => '80'
        ]);

        DocumentType::create([
            'name' => 'DNI',
            'code' => '96'
        ]);

        DocumentType::create([
            'name' => 'OTRO',
            'code' => '99'
        ]);

        DocumentType::create([
            'name' => 'CUIL',
            'code' => '86'
        ]);

        DocumentType::create([
            'name' => 'LE',
            'code' => '89'
        ]);

        DocumentType::create([
            'name' => 'LC',
            'code' => '90'
        ]);
    }
}
