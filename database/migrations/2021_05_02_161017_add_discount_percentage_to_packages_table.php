<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountPercentageToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->float('discount_percent',5,2)->default(0);
            $table->date('start_discount_at')->nullable();
            $table->date('end_discount_at')->nullable();

            $table->integer('extend_duration')->default(0);
            $table->date('start_extend_at')->nullable();
            $table->date('end_extend_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('discount_percent','start_discount_at','end_discount_at');
        });
    }
}
