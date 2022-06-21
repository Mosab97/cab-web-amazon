<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelReasonToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('cancel_reason_data')->nullable();
            $table->bigInteger('cancel_reason_id')->unsigned()->nullable();
            $table->foreign('cancel_reason_id')->references('id')->on('cancel_reasons')->onDelete('set null');
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
            $table->dropForeign('orders_cancel_reason_id_foreign');
            $table->dropColumn('cancel_reason_id','cancel_reason_data');
        });
    }
}
