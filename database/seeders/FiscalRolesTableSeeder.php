<?php

namespace Database\Seeders;

use App\Models\Administration\FiscalRole;
use Illuminate\Database\Seeder;

class FiscalRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FiscalRole::create([
            'name' => 'IVA Responsable Inscripto'
        ]);

        FiscalRole::create([
            'name' => 'Responsable Monotributo'
        ]);

        FiscalRole::create([
            'name' => 'IVA Exento'
        ]);

        FiscalRole::create([
            'name' => 'Consumidor Final'
        ]);
    }
}
