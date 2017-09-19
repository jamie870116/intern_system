<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendmailBcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_mail_bc', function (Blueprint $table) {
            $table->increments('slId');//AI
            $table->tinyInteger('lStatus')->default(0);//信件種類
            $table->string('lSender',50)->default('admin123');//寄件人帳號
            $table->string('lSenderName',50)->default('系辦');//寄件人名字
            $table->string('lRecipient',50);//收件人帳號
            $table->string('lRecipientName',50);//收件人名字
            $table->string('lTitle',100);//標題
            $table->longText('lContent')->nullable();//信件內容
            $table->longText('lNotes')->nullable();//信件備註(給前端參數用)
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
        Schema::dropIfExists('send_mail_bc');
    }
}
