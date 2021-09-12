<?php

namespace Database\Seeders;

use App\Models\Administration\DocumentType;
use App\Models\Administration\FiscalRole;
use App\Models\Administration\Supplier;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'given_name' => 'Bruno',
            'family_name' => 'Contartese',
            'address' => 'Roca 484',
            'phone_number' => '+5493364362286',
            'email' => 'soporte@codesolutions.com.ar',
            'fiscal_role_id' => FiscalRole::RESPONSABLE_MONOTRIBUTO,
            'document_type_id' => DocumentType::CUIT,
            'document_number' => '20366040642'
        ]);
    }
}
