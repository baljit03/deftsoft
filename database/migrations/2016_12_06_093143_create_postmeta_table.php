<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostmetaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_postmeta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('post_key');
            $table->enum('postmeta_type',['image', 'text','video'])->default('text');
            $table->text('post_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tbl_postmeta');
    }

}
