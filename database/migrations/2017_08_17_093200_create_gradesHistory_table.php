<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade_id')->unsigned()->nullable();
            $table->integer('teacher_id')->unsigned();
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('subject_id')->unsigned()->nullable();

            $table->foreign('student_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('grade_id')->references('id')->on('grades')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('note')->nullable();

            $table->unsignedTinyInteger('value_old')->nullable();
            $table->unsignedTinyInteger('value_new');
            $table->enum('action', ['insert grade', 'change grade', 'delete grade']);
            $table->dateTime('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades_histories');
    }
}
