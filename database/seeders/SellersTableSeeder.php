<?php

namespace Database\Seeders;

use App\Models\Administration\DocumentType;
use App\Models\Administration\Seller;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'given_name' => 'Bruno',
            'family_name' => 'Contartese',
            'address' => 'Roca 484',
            'document_type_id' => DocumentType::DNI,
            'document' => "36604064",
            'email' => "bruno.a.contartese@gmail.com",
            'celphone_number' => "5493364362286",
        ]);
    }
}
