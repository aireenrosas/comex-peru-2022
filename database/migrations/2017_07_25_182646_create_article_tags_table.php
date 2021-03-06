<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('article_tags', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_id');
          $table->integer('tag_id');
          //$table->foreign('article_id')->references('id')->on('articles');
          //$table->foreign('tag_id')->references('id')->on('tags');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_tags');
    }
}
