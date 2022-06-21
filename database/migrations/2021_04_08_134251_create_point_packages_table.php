<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transfer_type')->nullable();//order - wallet - other
            $table->string('user_type')->nullable();//driver - client - client_and_driver
            $table->float('amount',4,2)->default(0);
            $table->integer('points')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('point_package_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('point_package_id')->unsigned();
            $table->string('name')->nullable();
            $table->longText('desc')->nullable();
            $table->string('locale')->index();
            $table->unique(['point_package_id', 'locale']);
            $table->foreign('point_package_id')->references('id')->on('point_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_package_translations');
        Schema::dropIfExists('point_packages');
    }
}
