<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuCourseCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stu_course', function (Blueprint $table) {

            $table->increments('SCid');//AI
            $table->string('c_account',100);//企業統編
            $table->integer('sid');//學生編號
            $table->integer('tid');//老師編號
            $table->integer('mid');//媒合編號
            $table->integer('courseId');//課程編號
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
        Schema::dropIfExists('stu_course');
    }
}
