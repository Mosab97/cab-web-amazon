<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverTypeToDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('driver_type')->default('both'); //delivery - ride
        });

        Schema::table('update_requests', function (Blueprint $table) {
            $table->string('driver_type')->nullable(); //delivery - ride
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->text('order_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('driver_type');
        });

        Schema::table('update_requests', function (Blueprint $table) {
            $table->dropColumn('driver_type');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_details');
        });
    }
}
