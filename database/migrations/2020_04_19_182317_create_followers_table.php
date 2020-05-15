<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('image')->default('/followers/default.jpg');
            $table->BigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')
                ->references('id')->on('academic_years')
                ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('followers');
    }
}
