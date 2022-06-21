<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points')->default(0);
            $table->integer('number_of_orders')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->text('fcm_notification')->nullable();
            $table->string('user_type')->nullable();//driver - client - client_and_driver
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('point_offer_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('point_offer_id')->unsigned()->nullable();
            $table->foreign('point_offer_id')->references('id')->on('point_offers')->onDelete('cascade');
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
        Schema::dropIfExists('point_offer_user');
        Schema::dropIfExists('point_offers');
    }
}
