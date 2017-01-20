<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('parent_id');
            $table->integer('updated_by');
            $table->longText('content');
            $table->string('title');
            $table->string('post_slug');
            $table->string('custom_slug');
            $table->string('post_type');
            $table->string('meta_title');
            $table->mediumText('meta_description');
            $table->mediumText('meta_keywords');
            $table->mediumText('title1');
            $table->mediumText('title2');
            $table->mediumText('title3');
            $table->mediumText('tagline');
            $table->mediumText('short_description');
            $table->longText('long_description');
            $table->enum('status',['Active', 'Inactive'])->default('Inactive');
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
        Schema::drop('tbl_posts');
    }
}
