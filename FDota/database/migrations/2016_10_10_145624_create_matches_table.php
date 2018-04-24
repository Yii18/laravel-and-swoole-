<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('match_id')->comment('比赛id');
            $table->string('season')->nullable()->comment('比赛id');
            $table->integer('radiant_win')->comment('比赛结果');
            $table->integer('duration')->comment('持续时间');
            $table->integer('first_blood_time')->comment('一血时间');
            $table->dateTime('start_time')->comment('开始时间');
            $table->bigInteger('match_seq_num');
            $table->integer('game_mode')->comment('比赛模式');
            $table->integer('tower_status_radiant');
            $table->integer('tower_status_dire');
            $table->integer('barracks_status_radiant');
            $table->integer('barracks_status_dire');
            $table->integer('replay_salt')->nullable();
            $table->integer('lobby_type');
            $table->integer('human_players');
            $table->integer('leagueid');
            $table->integer('cluster');
            $table->integer('negative_votes');
            $table->integer('positive_votes');
            $table->integer('radiant_team_id')->nullable();
            $table->integer('radiant_name')->nullable();
            $table->integer('radiant_logo')->nullable();
            $table->integer('radiant_team_complete')->nullable();
            $table->integer('dire_team_id')->nullable();
            $table->integer('dire_name')->nullable();
            $table->integer('dire_logo')->nullable();
            $table->integer('dire_team_complete')->nullable();
            $table->integer('engine');
            $table->integer('radiant_captain')->nullable();
            $table->integer('dire_captain')->nullable();
            $table->integer('flags');
            $table->integer('radiant_score');
            $table->integer('dire_score');
            $table->integer('pre_game_duration');
            $table->timestamps();
            //            $table->integer('account_id')->comment('玩家id');
            //            $table->integer('hero_id')->comment('使用英雄');
            //            $table->integer('index')->comment('玩家所在位置');
            //            $table->string('kda')->comment('KDA');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
