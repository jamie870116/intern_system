<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewStuQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_stu_questions', function (Blueprint $table) {

            $table->increments('insQId');//AI
            $table->longText('insQuestion');//題目名稱
            $table->integer('insQuestionVer');//題目版本
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
        Schema::dropIfExists('interview_stu_questions');
    }
}
