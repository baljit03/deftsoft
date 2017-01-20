<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_job_opening', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('job_title');
            $table->string('exp_required');
            $table->string('job_location');
            $table->string('profession_exp');
            $table->string('no_of_vacancy');
            $table->mediumtext('job_summary');
			$table->longtext('skills');
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
        Schema::drop('tbl_job_opening');
    }
}
