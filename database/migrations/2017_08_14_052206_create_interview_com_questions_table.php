<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewComQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_com_questions', function (Blueprint $table) {

            $table->increments('insCQId');//AI
            $table->longText('insCQuestion');//題目名稱
            $table->integer('insCQuestionVer');//題目版本
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
        Schema::dropIfExists('interview_com_questions');
    }
}
