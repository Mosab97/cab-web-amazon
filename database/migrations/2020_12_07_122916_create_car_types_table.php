<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('car_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('car_type_id')->unsigned();
            $table->string('name');
            $table->longText('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['car_type_id', 'locale']);
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_type_translations');
        Schema::dropIfExists('car_types');
    }
}
