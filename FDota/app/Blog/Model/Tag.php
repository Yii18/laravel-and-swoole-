<?php

namespace App\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @var string 表名 */
    protected $table = 'tags';

    /** @var array 白名单 */
    protected $fillable = [
        'id', 'user_id', 'name', 'created_at' , 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Blog\Model\Posts', 'post_tag', 'tag_id', 'post_id');
    }
}
