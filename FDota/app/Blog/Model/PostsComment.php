<?php

namespace App\Blog\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PostsComment extends Model
{
    /** @var string 表名 */
    protected $table = 'posts_comment';

    /** @var array 字段白名单 */
    protected $fillable = [
        'id', 'post_id', 'user_id', 'content', 'created_at' , 'updated_at'
    ];

    /**
     * created_at 字段预处理
     * @param $date
     * @return mixed
     */
    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->diffForHumans();
    }
}
