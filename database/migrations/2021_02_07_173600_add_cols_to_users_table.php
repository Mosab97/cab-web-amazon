<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_birth_hijri')->nullable();
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->text('elm_reply')->nullable();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->char('plate_letter_right')->nullable();
            $table->char('plate_letter_middle')->nullable();
            $table->char('plate_letter_left')->nullable();
            $table->string('plate_numbers_only')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('plate_type')->nullable();
            $table->string('license_serial_number')->nullable();
        });

        Schema::table('update_requests', function (Blueprint $table) {
            $table->string('identity_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_birth_hijri')->nullable();
            $table->char('plate_letter_right')->nullable();
            $table->char('plate_letter_middle')->nullable();
            $table->char('plate_letter_left')->nullable();
            $table->string('plate_numbers_only')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('plate_type')->nullable();
            $table->string('license_serial_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth_hijri','date_of_birth');
        });

        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('elm_reply');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('plate_letter_right','plate_letter_middle','plate_letter_left','plate_number','license_serial_number','plate_numbers_only','plate_type');
        });

        Schema::table('update_requests', function (Blueprint $table) {
            $table->dropColumn('plate_letter_right','plate_letter_middle','plate_letter_left','plate_number','license_serial_number','identity_number','date_of_birth','date_of_birth_hijri','plate_numbers_only','plate_type');
        });
    }
}
