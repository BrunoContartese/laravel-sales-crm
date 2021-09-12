<?php

namespace Database\Seeders;

use App\Models\Accounting\AccountingRecordType;
use Illuminate\Database\Seeder;

class AccountingRecordTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountingRecordType::create([
            'name' => 'Patrimonial'
        ]);

        AccountingRecordType::create([
            'name' => 'Resultados'
        ]);
    }
}
