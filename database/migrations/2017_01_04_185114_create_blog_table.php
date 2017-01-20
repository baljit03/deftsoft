<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumtext('title');
            $table->string('category_id');
            $table->string('blog_slug');
            $table->string('custom_url');
            $table->longtext('description');
            $table->mediumtext('blogImg');
            $table->string('postedBy');
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tbl_blog');
    }

}
