<?php

namespace App\Dota2\Model;

use Illuminate\Database\Eloquent\Model;

class AdditionalUnit extends Model
{
    protected $table = 'additional_units';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'unitname', 'item_0', 'item_1', 'item_2', 'item_3', 'item_4', 'item_5', 'slot_id'
    ];
}
