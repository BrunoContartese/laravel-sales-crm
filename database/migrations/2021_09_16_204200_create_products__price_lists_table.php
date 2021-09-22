<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsPriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products__price_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_list_id')->references('id')->on('price_lists');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->decimal('rentability_aliquot', 8, 2);
            $table->decimal('untaxed_price', 8, 2);
            $table->decimal('aliquot', 8, 2);
            $table->decimal('taxed_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products__price_lists');
    }
}
