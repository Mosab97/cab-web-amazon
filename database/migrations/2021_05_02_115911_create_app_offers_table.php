<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('app_offer_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('app_offer_id')->unsigned();
            $table->string('name');
            $table->longText('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['app_offer_id', 'locale']);
            $table->foreign('app_offer_id')->references('id')->on('app_offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_offers');
    }
}
