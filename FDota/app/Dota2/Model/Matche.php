<?php

namespace App\Dota2\Model;

use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    protected $table = 'matches';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'match_id', 'season', 'radiant_win', 'duration', 'first_blood_time',
        'start_time', 'match_seq_num', 'game_mode', 'tower_status_radiant',
        'tower_status_dire', 'barracks_status_radiant', 'barracks_status_dire', 'replay_salt',
        'lobby_type', 'human_players', 'leagueid', 'cluster', 'positive_votes', 'negative_votes',
        'radiant_team_id', 'radiant_name', 'radiant_logo', 'radiant_team_complete', 'dire_team_id',
        'dire_name', 'dire_logo', 'dire_team_complete', 'engine', 'radiant_captain', 'dire_captain',
        'flags', 'radiant_score', 'dire_score', 'pre_game_duration', 'created_at', 'updated_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        $date = date('Y-m-d H:i:s', $date);
        return Carbon::parse($date);
    }
}
