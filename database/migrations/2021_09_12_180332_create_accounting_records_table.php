<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accounting_record_type_id')->references('id')->on('accounting_record_types');
            $table->string('hierarchy');
            $table->string('code');
            $table->string('description');
            $table->boolean('is_tax')->default(false);
            $table->boolean('non_monetary')->default(false);
            $table->boolean('automatic_adjustment')->default(false);
            $table->boolean('cancelatory_medium')->default(false);
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
        Schema::dropIfExists('accounting_records');
    }
}
