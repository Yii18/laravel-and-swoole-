<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qq extends Model {
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'ret', 'nickname', 'figureurl', 'figureurl_1', 'figureurl_2',
        'figureurl_qq_1', 'figureurl_qq_2', 'figureurl_qq_2', 'gender', 'created_at', 'updated_at'
    ];
    protected $table = 'qq';
}
