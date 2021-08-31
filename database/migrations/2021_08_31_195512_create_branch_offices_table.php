<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address")->nullable();
            $table->string("lat")->nullable();
            $table->string("long")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("email")->nullable();
            $table->string("whatsapp")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
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
        Schema::dropIfExists('branch_offices');
    }
}
