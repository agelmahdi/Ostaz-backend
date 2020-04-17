<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('result');
            $table->string('slug');
            $table->BigInteger('follower_id')->unsigned();
            $table->foreign('follower_id')
                ->references('id')->on('followers')
                ->onDelete('cascade');
            $table->BigInteger('quiz_id')->unsigned();
            $table->foreign('quiz_id')
                ->references('id')->on('quizzes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('results');
    }
}
