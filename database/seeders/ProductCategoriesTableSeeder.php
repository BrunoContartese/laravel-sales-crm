<?php

namespace Database\Seeders;

use App\Models\Administration\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Categoría 1'
        ]);

        ProductCategory::create([
            'name' => 'Categoría 2 ',
            'parent_id' => 1
        ]);
    }
}
