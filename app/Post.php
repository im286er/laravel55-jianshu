<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    // 覆写，定义索引中的type值
    public function searchableAs()
    {
        return 'post';
    }

    // 有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    protected $fillable = ['title', 'content'];

    /**
     * 文章的所有者
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function zans()
    {
        return $this->hasMany('App\Zan');
    }

    public function Zan($userId)
    {
        return $this->zans()->where('user_id', $userId);
    }

}
