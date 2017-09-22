<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;
use Auth;

class TopicsController extends Controller
{
    public function show(Topic $topic)
    {
    	// 带文章数的专题
    	$topic = Topic::withCount('postTopics')->find($topic->id);

    	// 专题的文章列表
    	$posts = $topic->posts()->orderByDesc('created_at')->take(10)->get();

    	// 属于我的文章，但是未投稿
    	$myPosts = Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();

        return view('topics.show', compact('topic', 'posts', 'myPosts'));
    }

    public function submit(Topic $topic)
    {	
        $this->validate(request(), [
        	'post_ids' => 'required|array'
        ]);

        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
        	\App\PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }

        return back();
    }
}
