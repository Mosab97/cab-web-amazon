<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('car_model_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('car_model_id')->unsigned();
            $table->string('name');
            $table->longText('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['car_model_id', 'locale']);
            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_model_translations');
        Schema::dropIfExists('car_models');
    }
}
