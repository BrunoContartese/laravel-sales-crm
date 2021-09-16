<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PassportClientsSeeder::class,
            FiscalRolesTableSeeder::class,
            PlansTableSeeder::class,
            CompaniesTableSeeder::class,
            BranchOfficesTableSeeder::class,
            DocumentTypesTableSeeder::class,
            PriceListsTableSeeder::class,
            SellersTableSeeder::class,
            DeliveryZonesTableSeeder::class,
            CustomersTableSeeder::class,
            ProductCategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            AccountingRecordTypesTableSeeder::class,
            SuppliersTableSeeder::class,
            TributesTableSeeder::class,
            TributeAliquotsTableSeeder::class,
        ]);
    }
}
