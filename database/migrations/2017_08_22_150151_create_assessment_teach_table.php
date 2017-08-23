<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentTeachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_teach', function (Blueprint $table) {
            $table->increments('asTId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->integer('teacherGrade1');//成績1
            $table->integer('teacherGrade2');//成績2
            $table->integer('teacherGrade3');//成績3
            $table->integer('teacherGrade4');//成績4
            $table->integer('teacherGrade5');//成績5
            $table->integer('teacherGrade6');//成績6
            $table->integer('teacherGrade7');//成績7
            $table->integer('teacherGrade8');//成績8
            $table->integer('teacherGrade9');//成績9
            $table->integer('teacherGrade10');//成績10
            $table->string('comment');//總評
            $table->integer('totalScore');//總成績
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
        Schema::dropIfExists('assessment_teach');
    }
}


