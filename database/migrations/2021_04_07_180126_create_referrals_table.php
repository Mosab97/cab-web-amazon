<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_user_id')->unsigned()->nullable();
            $table->foreign('parent_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('child_user_id')->unsigned()->nullable();
            $table->foreign('child_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('points')->default(0);
            $table->boolean('is_calc_points')->default(true);
            $table->string('referral_code')->nullable();

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
        Schema::dropIfExists('referrals');
    }
}
