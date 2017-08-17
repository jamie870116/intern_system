<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentComTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_com', function (Blueprint $table) {

            $table->increments('asId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->date('asStart');//實習開始
            $table->date('asEnd');//實習結束
            $table->string('asDepartment');//實習部門
            $table->string('asStuName');//實習生姓名
            $table->string('asComName');//實習單位
            $table->integer('asGrade1');//成績1
            $table->integer('asGrade2');//成績2
            $table->integer('asGrade3');//成績3
            $table->integer('asGrade4');//成績4
            $table->integer('asGrade5');//成績5
            $table->string('asComment1');//評論1
            $table->string('asComment2');//評論2
            $table->string('asComment3');//評論3
            $table->string('asComment4');//評論4
            $table->string('asComment5');//評論5
            $table->string('comment');//總評
            $table->integer('asSickLeave_days');//病假_天
            $table->integer('asSickLeave_hours');//病假_小時
            $table->integer('asOfficialLeave_days');//公假_天
            $table->integer('asOfficialLeave_hours');//公假_小時
            $table->integer('asCasualLeave_days');//事假_天
            $table->integer('asCasualLeave_hours');//事假_小時
            $table->integer('asMourningLeave_days');//喪假_天
            $table->integer('asMourningLeave_hours');//喪假_小時
            $table->integer('asAbsenteeism_days');//曠職_天
            $table->integer('asAbsenteeism_hours');//曠職_小時
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessment_com');
    }
}

