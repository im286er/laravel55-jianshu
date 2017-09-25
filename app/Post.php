<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

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

    // 属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany('App\PostTopic', 'post_id', 'id');
    }

    // 不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function($q) use ($topic_id) {
            $q->where('topic_id', $topic_id);
        });
    }

    // 全局scope的方式
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope("avaliable", function(Builder $builder) {
            $builder->whereIn('status', [0,1]);
        });
    }
}














