<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(true);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('app_ad_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('app_ad_id')->unsigned();
            $table->string('name')->nullable();
            $table->longText('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['app_ad_id', 'locale']);
            $table->foreign('app_ad_id')->references('id')->on('app_ads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_ad_translations');
        Schema::dropIfExists('app_ads');
    }
}
