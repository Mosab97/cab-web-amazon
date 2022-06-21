<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('car_type_id')->unsigned()->nullable();
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('set null');

            $table->text('car_type_data')->nullable();

            $table->text('start_location')->nullable();
            $table->text('end_location')->nullable();
            $table->string('distance')->nullable(); //In meter
            $table->string('expected_time')->nullable();//In Minutes
            $table->string('actual_time')->nullable();//In Minutes

            $table->longText('expected_route')->nullable();//Points


            $table->double('budget')->nullable();
            $table->double('deliver_price')->nullable();

            $table->string('order_type')->nullable(); //package - trip - order

            $table->string('app_commission')->nullable();
            $table->string('app_commission_percentage')->nullable();

            $table->string('total_price');

            $table->string('order_status')->default('pending'); // pending - order_ready - provider_set_driver_type - driver_accept - client_accept - driver_canceled - client_canceled - driver_pre_finished -  client_pre_finished - driver_finished - driver_refused
            $table->text('order_status_times')->nullable(); // pending - order_ready - provider_set_driver_type - driver_accept - client_accept - driver_canceled - client_canceled - driver_pre_finished -  client_pre_finished - driver_finished - driver_refused
            $table->timestamp('finished_at')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
