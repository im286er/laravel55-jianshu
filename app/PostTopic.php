<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model
{
    protected $table = 'post_topic';

    protected $fillable = ['post_id', 'topic_id'];
}
