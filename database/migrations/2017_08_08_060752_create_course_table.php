<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {

            $table->increments('courseId');//AI
            $table->string('courseName',100);//課程名稱
            $table->integer('courseJournal');//週誌數量
            $table->longText('courseDetail')->nullable();//課程內容
            $table->dateTime('courseStart');//課程開始日期
            $table->dateTime('courseEnd');//課程結束日期
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}
