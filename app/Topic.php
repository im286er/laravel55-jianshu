<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	// 属于这个专题的所有文章
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_topic', 'topic_id', 'post_id');
    }

    // 专题的文章数，用于withCount
    public function postTopics()
    {
        return $this->hasMany('App\PostTopic', 'topic_id', 'id');
    }
}
