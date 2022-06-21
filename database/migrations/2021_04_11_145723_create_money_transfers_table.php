<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transfer_from_id')->unsigned()->nullable();
            $table->foreign('transfer_from_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('transfer_to_id')->unsigned()->nullable();
            $table->foreign('transfer_to_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_used')->default(true);
            $table->float('amount',5,2)->default(0);
            $table->float('wallet_before',5,2)->default(0);
            $table->float('wallet_after',5,2)->default(0);
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
        Schema::dropIfExists('money_transfers');
    }
}
