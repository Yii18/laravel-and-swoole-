<?php

namespace App\Blog\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /** @var string 表名 */
    protected $table = 'posts';

    /** @var array 字段白名单 */
    protected $fillable = [
        'id', 'user_id', 'title', 'username', 'content', 'created_at' , 'updated_at'
    ];

    /**
     * 多对多关联标签
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany('App\Blog\Model\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * updated_at 字段预处理
     * @param $date
     * @return mixed
     */
    public function getUpdatedAtAttribute($date) {
        return Carbon::parse($date)->diffForHumans();
    }
}
