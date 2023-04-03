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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('g_name');
            $table->string('g_gender');
            $table->string('g_address');
            $table->string('g_post_office');
            $table->integer('g_pin_code');
            $table->integer('g_contact_1');
            $table->integer('g_contact_2')->nullable();
            $table->string('g_v_doc')->default('aadhaar');
            $table->string('adh_no');
            $table->string('g_photo')->nullable();
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
        Schema::dropIfExists('guardians');
    }
};
