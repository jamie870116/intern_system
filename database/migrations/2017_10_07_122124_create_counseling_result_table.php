<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounselingResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counseling_result', function (Blueprint $table) {
            $table->increments('counselingId');//AI
            $table->integer('SCid');//課程老師學生廠商連結
            $table->string('counselingAddress',150);//實習機構輔導地址
            $table->dateTime('counselingDate');//日期
            $table->string('cTeacherName',50);//實習機構輔導老師
            $table->longText('counselingContent');//輔導內容
            $table->longText('counselingPic');//成果_照片或短述
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
        Schema::dropIfExists('counseling_result');
    }
}
