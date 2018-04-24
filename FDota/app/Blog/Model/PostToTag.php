<?php

namespace App\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class PostToTag extends Model
{
    /** @var string 表名 */
    protected $table = 'post_tag';

    /** @var array 白名单 */
    protected $fillable = [
        'id', 'user_id', 'post_id', 'tag_id', 'created_at', 'updated_at'
    ];
}
