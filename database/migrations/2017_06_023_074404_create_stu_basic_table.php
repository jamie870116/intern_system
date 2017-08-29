<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStuBasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stu_basic', function (Blueprint $table) {
            $table->integer('sid');//id
            $table->primary('sid');//id
            $table->string('chiName',20);//chinese name
            $table->string('engName',50)->nullable();//english name
            $table->string('bornedPlace',20)->nullable();//出生地
            $table->date('birthday')->nullable();//生日
            $table->tinyInteger('gender')->nullable()->default(0);//性別
            $table->string('address',100)->nullable();//戶籍地址
            $table->string('email',100)->nullable();//email
            $table->string('contact',200)->nullable();//聯絡方式
            $table->tinyInteger('eTypes')->nullable();//目前學制 0，五專 1，二技 2，四技 3，研究所
            //語言能力
            $table->tinyInteger('ES')->nullable()->default(0);//英說
            $table->tinyInteger('ER')->nullable()->default(0);//英讀
            $table->tinyInteger('EW')->nullable()->default(0);//英寫
            $table->integer('TOEIC')->nullable()->default(0);//多益成績
            $table->integer('TOEFL')->nullable()->default(0);//托福成績

            $table->string('Oname',50)->nullable();//第二外語名稱
            $table->tinyInteger('OS')->nullable()->default(0);//第二外語名稱說
            $table->tinyInteger('OR')->nullable()->default(0);//第二外語名稱讀
            $table->tinyInteger('OW')->nullable()->default(0);//第二外語名稱寫

            //學歷
            $table->string('graduateYear',15)->nullable();//畢業年分
            $table->string('graduatedSchool',50)->nullable();//畢業學校
            $table->string('department',50)->nullable();//科系
            $table->string('section',50)->nullable();//科
            $table->longText('autobiography')->nullable();//自傳

            $table->string('profilePic',100)->nullable();//頭貼

            $table->string('licenceFile',100)->nullable();//證照檔案


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stu_basic');
    }
}