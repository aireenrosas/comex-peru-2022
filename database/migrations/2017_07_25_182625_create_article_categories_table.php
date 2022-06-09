<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('article_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_id');
          $table->integer('category_id');
          //$table->foreign('article_id')->references('id')->on('articles');
          //$table->foreign('category_id')->references('id')->on('categories');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_categories');
    }
}
