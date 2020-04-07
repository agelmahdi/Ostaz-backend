<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug_ar');
            $table->string('slug_en');
            $table->string('image')->default('categories/default.png');
            $table->text('details_ar');
            $table->text('details_en');
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
        Schema::dropIfExists('categories');
    }
}
