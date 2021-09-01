<?php

namespace Database\Seeders;

use App\Models\Administration\DeliveryZone;
use Illuminate\Database\Seeder;

class DeliveryZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryZone::create([
            'name' => 'Local'
        ]);
    }
}
