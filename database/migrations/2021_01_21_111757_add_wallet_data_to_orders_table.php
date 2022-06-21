<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWalletDataToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('wallet_amount')->default(0)->nullable();
            $table->boolean('is_paid_by_wallet')->nullable();
            $table->string('pay_type')->nullable(); //cash - wallet
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('wallet_amount','is_paid_by_wallet','pay_type');
        });
    }
}
