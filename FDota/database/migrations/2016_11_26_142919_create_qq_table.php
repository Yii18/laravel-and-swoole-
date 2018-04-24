<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qq', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ret')->default(0)->comment('返回码');
            $table->string('nickname')->default('')->comment('用户在QQ空间的昵称。');
            $table->string('figureurl')->default('')->comment('大小为30×30像素的QQ空间头像URL。');
            $table->string('figureurl_1')->default('')->comment('大小为50×50像素的QQ空间头像URL。');
            $table->string('figureurl_2')->default('')->comment('大小为100×100像素的QQ空间头像URL。');
            $table->string('figureurl_qq_1')->default('')->comment('大小为40×40像素的QQ头像URL。');
            $table->string('figureurl_qq_2')->default('')->comment('大小为100×100像素的QQ头像URL。');
            $table->string('gender')->default('')->comment('性别');
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
        Schema::dropIfExists('qq');
    }
}
