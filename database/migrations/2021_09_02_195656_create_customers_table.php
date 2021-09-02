<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('given_name');
            $table->string('family_name');
            $table->string("address");
            $table->foreignId('document_type_id')->references('id')->on('document_types');
            $table->string("document");
            $table->string("email")->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cellphone_number')->nullable();
            $table->foreignId('fiscal_role_id')->references('id')->on('fiscal_roles');
            $table->foreignId('price_list_id')->references('id')->on('price_lists');
            $table->foreignId('delivery_zone_id')->nullable()->references('id')->on('delivery_zones');
            $table->foreignId('seller_id')->references('id')->on('sellers');
            $table->boolean('enable_current_account')->default(false);
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->default('null');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->default('null');
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users')->default('null');
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
