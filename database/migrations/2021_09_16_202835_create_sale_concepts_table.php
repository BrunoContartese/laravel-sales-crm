<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_concepts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->default('null');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->default('null');
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users')->default('null');
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
        Schema::dropIfExists('sale_concepts');
    }
}
