<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_testmonial', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_profilImg');
            $table->string('projectImg');
            $table->longtext('feedbacks');
            $table->string('projectUrl');
            $table->string('videoUrl');
			 $table->enum('testimonial_type', ['text', 'video'])->default('text');
			 $table->enum('status', ['active', 'inactive','deleted'])->default('active');
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
        Schema::drop('client_testmonial');
    }
}
