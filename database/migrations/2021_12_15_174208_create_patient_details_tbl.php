<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDetailsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_previous_id');
            $table->string('title');
            $table->string('fname');
            $table->string('lname');
            $table->string('years');
            $table->string('months');
            $table->string('days');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('gender');
            $table->string('refer');
            $table->string('center');
            $table->string('agent');
            $table->string('investigation');
            $table->string('mode');
            $table->string('status');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('advance', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->date('date_of_adv');
            $table->date('final_payment_date');
            $table->string('created_by');

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
        Schema::dropIfExists('patient_details');
    }
}
