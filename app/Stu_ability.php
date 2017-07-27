<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_ability extends Model
{
    protected $table='stu_ability';
    protected $primaryKey = 'abiid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','abiType','abiName'
    ];


}


//<?php
//
//use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
//
//class CreateStuBasicTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//
//        Schema::create('stu_basic', function (Blueprint $table) {
//            $table->integer('sid');//id
//            $table->primary('sid');//id
//            $table->string('chiName',20);//chinese name
//            $table->string('engName',50)->nullable();//english name
//            $table->string('bornedPlace',20)->nullable();//出生地
//            $table->string('nativePlace',20)->nullable();//籍貫
//            $table->date('birthday')->nullable();//生日
//            $table->tinyInteger('gender')->nullable();//性別
//            $table->string('address',100)->nullable();//戶籍地址
//            $table->string('email',100)->nullable();//email
//            $table->string('contact',200)->nullable();//聯絡方式
//            //語言能力
//            $table->tinyInteger('ES')->nullable();//英說
//            $table->tinyInteger('ER')->nullable();//英讀
//            $table->tinyInteger('EW')->nullable();//英寫
//            $table->integer('TOEIC')->nullable();//多益成績
//            $table->integer('TOEFL')->nullable();//托福成績
//
//            $table->string('Oname',50)->nullable();//第二外語名稱
//            $table->tinyInteger('OS')->nullable();//第二外語名稱說
//            $table->tinyInteger('OR')->nullable();//第二外語名稱讀
//            $table->tinyInteger('OW')->nullable();//第二外語名稱寫
//
//            //學歷
//            $table->tinyInteger('eduSystem')->nullable();//學制
//            $table->string('graduateYear',15)->nullable();//畢業年分
//            $table->string('graduatedSchool',50)->nullable();//畢業學校
//            $table->string('department',50)->nullable();//科系
//            $table->string('section',50)->nullable();//科
//            $table->longText('autobiography')->nullable();//自傳
//
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('stu_basic');
//    }
//}
