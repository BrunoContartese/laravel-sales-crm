<?php

namespace Database\Seeders;

use App\Models\Administration\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'barcode' => '7793704000881',
            'name' => 'Yerba Mate Despalada Playadito x 500grs',
            'description' => 'Yerba mate despalada',
            'product_img_url' => 'https://d1on8qs0xdu5jz.cloudfront.net/webapp/images/productos/b/0000010000/10453.jpg',
            'product_category_id' => 2,
            'tribute_aliquot_id' => 3
        ]);

        $product->branchOfficeStock()->sync([1 => [
            'current_stock' => 1,
            'minimum_stock' => 1,
        ]]);

        $product->suppliers()->sync([1 => [
            'cost_price' => 190,
        ]]);
    }
}
