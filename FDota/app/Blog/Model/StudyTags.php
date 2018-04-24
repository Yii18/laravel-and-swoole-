<?php

namespace App\Blog\Model;

use Illuminate\Database\Eloquent\Model;

class StudyTags extends Model
{
    /** @var string 表名 */
    protected $table = 'study_tags';

    /** @var array 字段白名单 */
    protected $fillable = [
        'id', 'title', 'created_at', 'updated_at'
    ];
}
