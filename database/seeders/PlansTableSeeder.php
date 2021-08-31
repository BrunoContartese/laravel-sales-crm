<?php

namespace Database\Seeders;

use App\Models\Administration\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'plan_name' => 'Starter',
            'users_allowed' => 2,
            'branch_offices_allowed' => 1,
            'boxes_per_branch_office_allowed' => 1,
            'bills_per_month_allowed' => 100,
        ]);

        Plan::create([
            'plan_name' => 'Basic',
            'users_allowed' => 2,
            'branch_offices_allowed' => 1,
            'boxes_per_branch_office_allowed' => 1,
            'bills_per_month_allowed' => 300,
        ]);

        Plan::create([
            'plan_name' => 'Medium',
            'users_allowed' => 5,
            'branch_offices_allowed' => 1,
            'boxes_per_branch_office_allowed' => 2,
            'bills_per_month_allowed' => 1000,
        ]);

        Plan::create([
            'plan_name' => 'Advance',
            'users_allowed' => 10,
            'branch_offices_allowed' => 2,
            'boxes_per_branch_office_allowed' => 3,
            'bills_per_month_allowed' => 20000,
        ]);

        Plan::create([
            'plan_name' => 'Premium',
            'users_allowed' => 999,
            'branch_offices_allowed' => 999,
            'boxes_per_branch_office_allowed' => 999,
            'bills_per_month_allowed' => 10000000,
        ]);
    }
}
