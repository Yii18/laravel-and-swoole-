<?php

namespace App\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    /** @var string 表名 */
    protected $table = 'study';

    /** @var array 字段白名单 */
    protected $fillable = [
        'id', 'study_tags_id', 'title', 'img', 'url', 'created_at', 'updated_at'
    ];

}
