<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('coll_center_id')->nullable();
            $table->string('ledger_type')
            ->comment('OB- opening Balance, WR- Wallet Recharge, PB- Patient Bill')
            ->nullable();
            $table->decimal('open_balance',10,2)->nullable();
            $table->decimal('credit',10,2)->nullable();
            $table->decimal('debit', 10, 2)->nullable();
            $table->integer('transaction_id')->nullable();
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
        Schema::dropIfExists('ledgers');
    }
}
