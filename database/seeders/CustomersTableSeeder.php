<?php

namespace Database\Seeders;

use App\Models\Administration\Customer;
use App\Models\Administration\DocumentType;
use App\Models\Administration\FiscalRole;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'given_name' => "Consumidor",
            'family_name' => "Final",
            'address' => "-",
            'document_type_id' => DocumentType::OTRO,
            'document' => "0",
            'fiscal_role_id' => FiscalRole::CONSUMIDOR_FINAL,
            'price_list_id' => 1,
            'delivery_zone_id' => 1,
            'seller_id' => 1,
        ]);
    }
}
