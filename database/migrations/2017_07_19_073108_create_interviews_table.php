<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('inid');//AI
            $table->integer('mid');//媒合ID
            $table->string('inadress',200);//面試地點
            $table->dateTime('intime');
            $table->string('jcontact_name',20);//聯絡人姓名
            $table->string('jcontact_phone',50);//聯絡人電話
            $table->string('jcontact_email',150);//聯絡人信箱
            $table->longText('innotice')->nullable();//注意事項
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
        Schema::dropIfExists('interviews');
    }
}
