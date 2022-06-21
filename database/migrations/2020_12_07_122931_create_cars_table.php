<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('car_type_id')->nullable();
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade');

            $table->unsignedBigInteger('car_model_id')->nullable();
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');

            $table->string('car_licence_image')->nullable();
            // $table->string('diving_licence_no')->nullable();

            $table->string('car_insurance_image')->nullable();
            $table->string('car_form_image')->nullable();
            $table->string('car_front_image')->nullable();
            $table->string('car_back_image')->nullable();

            // $table->string('car_number')->nullable();
            $table->string('manufacture_year')->nullable();


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
        Schema::dropIfExists('cars');
    }
}
