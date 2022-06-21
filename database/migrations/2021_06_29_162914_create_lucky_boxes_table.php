<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuckyBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lucky_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('gift_type')->nullable(); //balance - point - other
            $table->string('points')->nullable();
            $table->string('balance')->nullable();

            $table->boolean('is_active')->default(true);

            $table->string('user_type')->nullable();//client - driver - client_and_driver

            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });

        Schema::create('lucky_box_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lucky_box_id')->unsigned();
            $table->string('name');
            $table->text('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['lucky_box_id', 'locale']);
            $table->foreign('lucky_box_id')->references('id')->on('lucky_boxes')->onDelete('cascade');
        });

        Schema::create('gift_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('lucky_box_id')->unsigned();
            $table->foreign('lucky_box_id')->references('id')->on('lucky_boxes')->onDelete('cascade');

            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('gift_user');
        Schema::dropIfExists('lucky_box_translations');
        Schema::dropIfExists('lucky_boxes');
    }
}
