<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement', function (Blueprint $table) {

            $table->increments('anId');//AI
            $table->string('anTittle',100);//公告標題
            $table->longText('anContent');//公告內容
//            $table->tinyInteger('showStu')->default(1);//是否顯示給學生 0，否 1，是
//            $table->tinyInteger('showTea');//是否顯示給學生
//            $table->tinyInteger('showCom');//是否顯示給學生
            $table->string('anFile',500);//副檔(多個)

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
        Schema::dropIfExists('announcement');
    }
}
