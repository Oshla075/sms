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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string("sys_logo")->nullable();
            $table->string("sys_name");
            $table->string("sys_contact1");
            $table->string("sys_contact2")->nullable();
            $table->string("sys_contact3")->nullable();
            $table->string("sys_type");
            $table->string("sys_body")->nullable();
            $table->string("sys_mail");
            $table->string("sys_web_address")->nullable();
            $table->string("sys_social_link")->nullable();
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
        Schema::dropIfExists('systems');
    }
};
