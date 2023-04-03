<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('s_adh_no');
            $table->string('s_name');
            $table->integer('s_contact');
            $table->string('s_address');
            $table->string('s_post_office');
            $table->integer('s_pin_code');
            $table->string('s_dob');
            $table->integer('s_cls_id');
            $table->integer('s_sec_id');
            $table->string('s_roll');
            $table->integer('s_capacity');
            $table->string('s_regn');
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
        Schema::dropIfExists('students');
    }
};
