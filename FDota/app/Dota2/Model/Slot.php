<?php

namespace App\Dota2\Model;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';

    protected $primaryKey = 'slots_id';

    protected $fillable = [
        'slots_id', 'id', 'account_id', 'player_slot', 'hero_id',
        'item_0', 'item_1', 'item_2' , 'item_3', 'item_4', 'item_5',
        'kills' , 'deaths', 'assists', 'leaver_status', 'gold', 'last_hits',
        'denies', 'gold_per_min', 'xp_per_min', 'gold_spent', 'hero_damage', 'tower_damage',
        'hero_healing', 'level', 'match_id', 'created_at', 'updated_at'
    ];
}
