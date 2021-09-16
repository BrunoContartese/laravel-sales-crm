<?php

namespace Database\Seeders;

use App\Models\Accounting\SaleConcept;
use Illuminate\Database\Seeder;

class SaleConceptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleConcept::create([
            'name' => 'Productos'
        ]);

        SaleConcept::create([
            'name' => 'Servicios'
        ]);

        SaleConcept::create([
            'name' => 'Productos y Servicios'
        ]);
    }
}
