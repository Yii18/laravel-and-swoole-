<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->increments('slots_id');
            $table->integer('id')->nullable();
            $table->bigInteger('account_id');
            $table->integer('player_slot');
            $table->integer('hero_id');
            $table->integer('kills')->comment('k');
            $table->integer('deaths')->comment('d');
            $table->integer('assists')->comment('a');
            $table->integer('leaver_status');
            $table->integer('gold');
            $table->integer('last_hits');
            $table->integer('denies');
            $table->integer('gold_per_min');
            $table->integer('xp_per_min');
            $table->integer('gold_spent');
            $table->integer('hero_damage');
            $table->integer('tower_damage');
            $table->integer('hero_healing');
            $table->integer('level');
            $table->bigInteger('match_id');
            $table->integer('item_0');
            $table->integer('item_1');
            $table->integer('item_2');
            $table->integer('item_3');
            $table->integer('item_4');
            $table->integer('item_5');
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
        Schema::dropIfExists('slots');
    }
}
