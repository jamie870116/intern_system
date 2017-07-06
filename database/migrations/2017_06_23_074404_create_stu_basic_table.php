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
            $table->string('nativePlace',20)->nullable();//籍貫
            $table->date('birthday')->nullable();//生日
            $table->tinyInteger('gender')->nullable();//性別
            $table->float('height',8,2)->nullable();//身高
            $table->float('weight',8,2)->nullable();//體重
            $table->string('bloodtype',5)->nullable();//血型
            $table->string('address',100)->nullable();//戶籍地址
            $table->string('email',100)->nullable();//email
            $table->string('contact',200)->nullable();//聯絡方式
            //語言能力
            $table->tinyInteger('CL')->nullable();//中聽
            $table->tinyInteger('CS')->nullable();//中說
            $table->tinyInteger('CR')->nullable();//中讀
            $table->tinyInteger('CW')->nullable();//中寫
            $table->tinyInteger('EL')->nullable();//英聽
            $table->tinyInteger('ES')->nullable();//英說
            $table->tinyInteger('ER')->nullable();//英讀
            $table->tinyInteger('EW')->nullable();//英寫
            $table->tinyInteger('TL')->nullable();//台聽
            $table->tinyInteger('TS')->nullable();//台說
            //技術
            $table->string('dataBase',300)->nullable();//資料庫
            $table->string('programmingLanguage',300)->nullable();//程式語言
            $table->string('webDesign',300)->nullable();//網頁設計
            $table->string('document',300)->nullable();//文書處裡
            $table->string('imageProcessing',300)->nullable();//影像剪輯
            $table->string('drawingSoftware',300)->nullable();//繪圖軟體
            $table->string('animation',300)->nullable();//動畫製作
            $table->string('OS',300)->nullable();//作業系統
            $table->string('musicEditor',300)->nullable();//音效剪輯

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
