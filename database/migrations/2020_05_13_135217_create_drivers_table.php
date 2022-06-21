<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->string('licence_image')->nullable();
            $table->string('licence_number')->nullable();

            $table->string('car_image')->nullable();
            $table->string('car_number')->nullable();

            $table->string('location')->nullable();
            $table->float('lat',8,4)->nullable();
            $table->float('lng',8,4)->nullable();

            $table->boolean('is_available')->nullable();
            $table->boolean('is_admin_accept')->default(false);
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
        Schema::dropIfExists('drivers');
    }
}
