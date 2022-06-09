<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('cover')->nullable();
          $table->integer('created_by');
          $table->boolean('is_open');
          $table->boolean('has_languages');
          $table->integer('updated_by');
          $table->dateTime('published_at')->nullable();
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
        Schema::drop('articles');
    }
}
