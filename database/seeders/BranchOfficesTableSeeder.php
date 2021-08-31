<?php

namespace Database\Seeders;

use App\Models\Administration\BranchOffice;
use Illuminate\Database\Seeder;

class BranchOfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::create([
            'name' => 'Casa central'
        ]);
    }
}
