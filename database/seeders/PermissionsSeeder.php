<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersModulePermissionsSeeder::class,
            RolesModulePermissionsSeeder::class,
            CompaniesModulePermissionsSeeder::class,
            BranchOfficesModulePermissionsSeeder::class,
            PriceListsModulePermissionsSeeder::class,
            SellersModulePermissionsSeeder::class,
            DeliveryZonesModulePermissionsSeeder::class,
            CustomersModulePermissionsSeeder::class,
            ProductCategoriesModulePermissionsSeeder::class,
            ProductsModulePermissionsSeeder::class,
            SuppliersModulePermissionsSeeder::class,
            TributesModulePermissionsSeeder::class,
        ]);
    }
}
