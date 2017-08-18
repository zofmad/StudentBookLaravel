<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_subject', function (Blueprint $table) {

          $table->integer('classroom_id')->unsigned();
          $table->integer('subject_id')->unsigned();

          $table->foreign('classroom_id')->references('id')->on('classrooms')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('subject_id')->references('id')->on('subjects')
              ->onUpdate('cascade')->onDelete('cascade');

          $table->primary(['classroom_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_subject');
    }
}
