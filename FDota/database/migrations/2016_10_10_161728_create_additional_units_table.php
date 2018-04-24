<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unitname');
            $table->integer('item_0');
            $table->integer('item_1');
            $table->integer('item_2');
            $table->integer('item_3');
            $table->integer('item_4');
            $table->integer('item_5');
            $table->integer('slot_id');
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
        Schema::dropIfExists('additional_units');
    }
}
