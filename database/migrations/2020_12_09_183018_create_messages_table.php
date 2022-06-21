<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_id')->unsigned()->nullable();
			$table->foreign('chat_id')
				  ->references('id')->on('chats')
				   ->onDelete('cascade');

		    $table->bigInteger('sender_id')->unsigned();
			$table->foreign('sender_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');

			$table->bigInteger('receiver_id')->unsigned()->nullable();
			$table->foreign('receiver_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');

          $table->bigInteger('order_id')->unsigned()->nullable();
          $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');

			$table->longText('message');
			$table->string('message_type')->default('text');
			$table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
