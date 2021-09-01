<?php

namespace Database\Seeders;

use App\Models\Accounting\PriceList;
use Illuminate\Database\Seeder;

class PriceListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceList::create([
            'name' => 'Minorista'
        ]);
    }
}
