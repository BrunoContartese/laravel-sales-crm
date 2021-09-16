<?php

namespace Database\Seeders;

use App\Models\Accounting\Tribute;
use App\Models\Accounting\TributeAliquot;
use Illuminate\Database\Seeder;

class TributeAliquotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "3",
            'aliquot' => 0
        ]);

        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "4",
            'aliquot' => 10.5
        ]);

        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "5",
            'aliquot' => 21
        ]);

        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "6",
            'aliquot' => 27
        ]);

        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "8",
            'aliquot' => 5
        ]);

        TributeAliquot::create([
            'tribute_id' => Tribute::IVA,
            'code' => "9",
            'aliquot' => 2.5
        ]);
    }
}
