<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subject', function (Blueprint $table) {

          $table->integer('class_id')->unsigned();
          $table->integer('subject_id')->unsigned();

          $table->foreign('class_id')->references('id')->on('permissions')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('subject_id')->references('id')->on('roles')
              ->onUpdate('cascade')->onDelete('cascade');

          $table->primary(['class_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_subject');
    }
}
