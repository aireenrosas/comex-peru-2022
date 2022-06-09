<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('seminars', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('month');
          $table->integer('day');
          $table->integer('year');
          $table->date('date');
          $table->string('place');
          $table->string('file');
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
        Schema::dropIfExists('seminars');
    }
}
