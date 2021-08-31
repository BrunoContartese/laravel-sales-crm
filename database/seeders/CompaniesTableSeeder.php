<?php

namespace Database\Seeders;

use App\Models\Administration\Company;
use App\Models\Administration\FiscalRole;
use App\Models\Administration\Plan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'plan_id' => Plan::PREMIUM,
            'fiscal_role_id' => FiscalRole::RESPONSABLE_MONOTRIBUTO,
            'is_perception_agent' => false,
            'name' => 'Codesolutions',
            'owner_name' => 'Bruno Contartese',
            'document_number' => '20366040642',
            'gross_incomes_document_number' => '20366040642',
            'activities_init_date' => Carbon::parse('02/01/2017')->format('Y-m-d')
        ]);
    }
}
