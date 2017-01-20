<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumtext('title');
            $table->string('category_id');
            $table->string('portfolioImg');
            $table->string('projectUrl');
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
        Schema::drop('tbl_portfolio');
    }

}
