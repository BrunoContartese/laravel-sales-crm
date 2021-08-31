<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->references('id')->on('plans');
            $table->foreignId('fiscal_role_id')->references('id')->on('fiscal_roles');
            $table->boolean('is_perception_agent')->default(false);
            $table->string('name');
            $table->string('owner_name');
            $table->string('document_number');
            $table->string('gross_incomes_document_number');
            $table->date('activities_init_date');
            $table->text('afip_key_file_url')->nullable();
            $table->text('afip_cert_file_url')->nullable();
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
        Schema::dropIfExists('company');
    }
}
