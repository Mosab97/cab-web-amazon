<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('added_by_id')->unsigned()->nullable();
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('point_package_id')->unsigned()->nullable();
            $table->foreign('point_package_id')->references('id')->on('point_packages')->onDelete('cascade');

            $table->integer('points')->default(0);
            $table->boolean('is_calc_points')->default(true);
            $table->enum('status',['add','sub'])->nullable();
            $table->string('reason')->nullable();//order - referal code - .... etc
            $table->text('package_data')->nullable();
            $table->boolean('is_used')->default(true);
            $table->float('amount',5,2)->default(0);
            $table->string('transfer_type')->nullable();//order - wallet - other
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
        Schema::dropIfExists('user_points');
    }
}
