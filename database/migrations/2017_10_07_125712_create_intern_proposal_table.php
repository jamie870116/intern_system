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
            $table->string('stuClass',20)->nullable();//學生班級
            $table->string('comDepartment',50)->nullable();//實習部門
            $table->string('comInstructor',10)->nullable();//實習機構輔導老師
            $table->date('IPStart')->nullable();//實習開始日期
            $table->date('IPEnd')->nullable();//實習結束日期
            $table->longText('IPGoal')->nullable();//實習目標
            $table->longText('IPDescription')->nullable();//實習課程內涵
            $table->longText('IPTopic1')->nullable();//實習主題之一
            $table->dateTime('IPTopic1Start')->nullable();//實習主題之一 開始
            $table->dateTime('IPTopic1End')->nullable();//實習主題之一 結束
            $table->longText('IPTopic2')->nullable();//實習主題之二
            $table->dateTime('IPTopic2Start')->nullable();//實習主題之二 開始
            $table->dateTime('IPTopic2End')->nullable();//實習主題之二 結束
            $table->longText('IPTopic3')->nullable();//實習主題之三
            $table->dateTime('IPTopic3Start')->nullable();//實習主題之三 開始
            $table->dateTime('IPTopic3End')->nullable();//實習主題之三 結束
            $table->longText('IPTopic4')->nullable();//實習主題之四
            $table->dateTime('IPTopic4Start')->nullable();//實習主題之四 開始
            $table->dateTime('IPTopic4End')->nullable();//實習主題之四 結束
            $table->longText('IPTopic5')->nullable();//實習主題之五
            $table->dateTime('IPTopic5Start')->nullable();//實習主題之五 開始
            $table->dateTime('IPTopic5End')->nullable();//實習主題之五 結束
            $table->longText('IPTopic6')->nullable();//實習主題之六
            $table->dateTime('IPTopic6Start')->nullable();//實習主題之六 開始
            $table->dateTime('IPTopic6End')->nullable();//實習主題之六 結束
            $table->longText('IPTopic7')->nullable();//實習主題之七
            $table->dateTime('IPTopic7Start')->nullable();//實習主題之七 開始
            $table->dateTime('IPTopic7End')->nullable();//實習主題之七 結束
            $table->longText('IPTopic8')->nullable();//實習主題之八
            $table->dateTime('IPTopic8Start')->nullable();//實習主題之八 開始
            $table->dateTime('IPTopic8End')->nullable();//實習主題之八 結束

            $table->longText('IPInstruction')->nullable();//實習機構參與實習課程說明
            $table->longText('IPComPlanning')->nullable();//業界專家輔導實習課程規劃
            $table->longText('IPTeaPlanning')->nullable();//學校老師輔導實習課程規劃
            $table->longText('IPIndicators')->nullable();//實習成效考核指標或項目
            $table->longText('IPAssessment')->nullable();//實習成效與教學評核方式
            $table->longText('IPFeedback')->nullable();//實習課後回饋計畫
            $table->tinyInteger('IPRead')->default(0);//是否查閱

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
