<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('user_slug');
            $table->string('zipcode');
            $table->string('address1');
            $table->string('address2');
            $table->string('profie_image');
            $table->string('timezone');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('status', ['active', 'inactive','deleted'])->default('active');
            $table->enum('usertype', ['superadmin', 'admin','others'])->default('others');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
