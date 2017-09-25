<?php 

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller 
{
    public function index()
    {
        // status = 0, 未通过审核的文章
        $posts = Post::withoutGlobalScope('avaliable')
            ->where('status', 0)->orderByDesc('created_at')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function status(Post $post, Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:-1,1',
        ]);

        $post->status = request('status');
        $post->save();

        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}