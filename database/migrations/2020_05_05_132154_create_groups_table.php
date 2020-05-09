<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('title');
            $table->String('slug');
            $table->Text('description');
            $table->BigInteger('streamer_id')->unsigned();
            $table->foreign('streamer_id')
                ->references('id')->on('streamers')
                ->onDelete('cascade');
            $table->BigInteger('academic_year_id')->unsigned();
            $table->foreign('academic_year_id')
                ->references('id')->on('academic_years')
                ->onDelete('cascade');
            $table->BigInteger('subject_id')->unsigned();
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onDelete('cascade');
            $table->String('start');
            $table->String('end');
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
        Schema::dropIfExists('groups');
    }
}
