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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->string('stu_id');
            $table->integer('s_cls_id');
            $table->integer('s_sec_id');
            $table->string('s_roll');
            $table->integer('s_year');
            $table->integer('s_r_fees');
            $table->integer('s_t_fees');
            $table->integer('s_o_fees');
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
        Schema::dropIfExists('student_payments');
    }
};
