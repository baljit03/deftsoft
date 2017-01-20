<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_job_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id');
            $table->string('app_name');
            $table->string('app_email');
            $table->string('app_phone');
            $table->string('app_resume');
            $table->enum('status', ['active', 'inactive', 'rejected'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tbl_job_applications');
    }

}
