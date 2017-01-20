<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterMenuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_footer_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('post_id');
            $table->integer('sort_index');
            $table->string('section_title');
            $table->string('name');
            $table->enum('footer_section', ['section1', 'section2', 'section3', 'section4'])->default('section1');
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
        Schema::drop('tbl_footer_menu');
    }

}
