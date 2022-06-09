<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('summits', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('title');
          $table->text('description');
          $table->string('url');
          $table->integer('month');
          $table->integer('day');
          $table->integer('year');
          $table->date('date');
          $table->time('time');
          $table->string('place');
          $table->integer('created_by');
          $table->integer('updated_by');
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
        Schema::dropIfExists('summits');
    }
}
