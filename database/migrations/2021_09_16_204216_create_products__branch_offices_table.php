<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products__branch_offices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_office_id')->references('id')->on('branch_offices');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('current_stock');
            $table->unsignedBigInteger('minimum_stock');
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
        Schema::dropIfExists('products__branch_offices');
    }
}
