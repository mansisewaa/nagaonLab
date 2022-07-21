<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId("test_id")->constrained();

            $table->unsignedBigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patient_details')->onDelete('cascade');
            $table->string("invastigation_name")->comment("test name");
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
        Schema::dropIfExists('test_transaction');
    }
}
