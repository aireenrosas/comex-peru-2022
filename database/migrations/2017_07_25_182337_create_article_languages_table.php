<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('article_languages', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('article_id');
          $table->integer('language_id');
          $table->string('title');
          $table->string('slug');
          $table->text('content');
          $table->string('leyend')->nullable();
          $table->string('source')->nullable();
          $table->string('file')->nullable();
          $table->text('document');
          $table->timestamps();
          //$table->foreign('article_id')->references('id')->on('articles');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
