<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->BigInteger('category_id')->unsigned();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug_ar');
            $table->string('slug_en');
            $table->string('image')->default('categories/default.png');
            $table->text('details_ar');
            $table->text('details_en');
            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        Schema::dropIfExists('sub_categories');
    }
}
