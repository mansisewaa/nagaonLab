<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentWalletRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_wallet_recharges', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_of_request')->nullable();
            $table->decimal('amount_requested',10,2)->nullable();
            $table->string('order_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payment_details')->nullable();
            $table->string('payment_status')->comment('F-Failed,S-Success')->nullable();
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
        Schema::dropIfExists('payment_wallet_recharges');
    }
}
