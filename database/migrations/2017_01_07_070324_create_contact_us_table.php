<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contactus_queries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user_ip');
			$table->string('email');
            $table->string('phone_number');
            $table->string('message_content');
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
        Schema::drop('tbl_contactus_queries');
    }
}
