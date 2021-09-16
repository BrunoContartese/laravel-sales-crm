<?php

namespace Database\Seeders;

use App\Models\Accounting\Tribute;
use Illuminate\Database\Seeder;

class TributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tribute::create([
            'name' => 'IVA'
        ]);

        Tribute::create([
            'code' => "1",
            'name' => 'Impuestos Nacionales'
        ]);

        Tribute::create([
            'code' => "2",
            'name' => 'Impuestos Provinciales'
        ]);

        Tribute::create([
            'code' => "3",
            'name' => 'Impuestos Municipales'
        ]);

        Tribute::create([
            'code' => "4",
            'name' => 'Impuestos Internos'
        ]);

        Tribute::create([
            'code' => "99",
            'name' => 'Otro'
        ]);

        Tribute::create([
            'code' => "5",
            'name' => 'IIBB'
        ]);

        Tribute::create([
            'code' => "6",
            'name' => 'Percepción de IVA'
        ]);

        Tribute::create([
            'code' => "7",
            'name' => 'Percepción de IIBB'
        ]);

        Tribute::create([
            'code' => "8",
            'name' => 'Percepciones por impuestos municipales'
        ]);

        Tribute::create([
            'code' => "9",
            'name' => 'Otras Percepciones'
        ]);

        Tribute::create([
            'code' => "13",
            'name' => 'Percepción de IVA a no categorizado'
        ]);

        
    }
}
