<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessPartnerAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_business_partners_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('user_ip');
            $table->string('email');
            $table->string('business_type');
            $table->mediumtext('Classification');
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
        Schema::drop('tbl_business_partners_applications');
    }
}
