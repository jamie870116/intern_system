<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intern_proposal', function (Blueprint $table) {
            $table->increments('IPId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->string('stuClass',20);//學生班級
            $table->string('comDepartment',50);//實習部門
            $table->string('comInstructor',10);//實習機構輔導老師
            $table->date('IPStart');//實習開始日期
            $table->date('IPEnd');//實習結束日期
            $table->longText('IPGoal');//實習目標
            $table->longText('IPDescription');//實習課程內涵
            $table->longText('IPTopic1');//實習主題之一
            $table->dateTime('IPTopic1Start');//實習主題之一 開始
            $table->dateTime('IPTopic1End');//實習主題之一 結束
            $table->longText('IPTopic2');//實習主題之二
            $table->dateTime('IPTopic2Start');//實習主題之二 開始
            $table->dateTime('IPTopic2End');//實習主題之二 結束
            $table->longText('IPTopic3');//實習主題之三
            $table->dateTime('IPTopic3Start');//實習主題之三 開始
            $table->dateTime('IPTopic3End');//實習主題之三 結束
            $table->longText('IPTopic4');//實習主題之四
            $table->dateTime('IPTopic4Start');//實習主題之四 開始
            $table->dateTime('IPTopic4End');//實習主題之四 結束
            $table->longText('IPTopic5');//實習主題之五
            $table->dateTime('IPTopic5Start');//實習主題之五 開始
            $table->dateTime('IPTopic5End');//實習主題之五 結束
            $table->longText('IPTopic6');//實習主題之六
            $table->dateTime('IPTopic6Start');//實習主題之六 開始
            $table->dateTime('IPTopic6End');//實習主題之六 結束
            $table->longText('IPTopic7');//實習主題之七
            $table->dateTime('IPTopic7Start');//實習主題之七 開始
            $table->dateTime('IPTopic7End');//實習主題之七 結束
            $table->longText('IPTopic8');//實習主題之八
            $table->dateTime('IPTopic8Start');//實習主題之八 開始
            $table->dateTime('IPTopic8End');//實習主題之八 結束

            $table->longText('IPInstruction');//實習機構參與實習課程說明
            $table->longText('IPComPlanning');//業界專家輔導實習課程規劃
            $table->longText('IPTeaPlanning');//學校老師輔導實習課程規劃
            $table->longText('IPIndicators');//實習成效考核指標或項目
            $table->longText('IPAssessment');//實習成效與教學評核方式
            $table->longText('IPFeedback');//實習課後回饋計畫

            $table->timestamps();//時間戳
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intern_proposal');
    }
}
