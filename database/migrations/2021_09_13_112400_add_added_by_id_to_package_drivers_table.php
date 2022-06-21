<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddedByIdToPackageDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_drivers', function (Blueprint $table) {
            $table->bigInteger('added_by_id')->unsigned()->nullable();
            $table->foreign('added_by_id')->references('id')->on('users')->onDelete('set null');
            $table->bigInteger('updated_by_id')->unsigned()->nullable();
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_drivers', function (Blueprint $table) {
            $table->dropForeign('package_drivers_added_by_id_foreign');
            $table->dropForeign('package_drivers_updated_by_id_foreign');
            $table->dropColumn('added_by_id','updated_by_id');
        });
    }
}
