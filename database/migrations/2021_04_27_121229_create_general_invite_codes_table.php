<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInviteCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_invite_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points')->default(0);
            $table->string('code')->nullable();
            $table->bigInteger('added_by_id')->unsigned()->nullable();
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('set null');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('general_invite_codes');
    }
}
