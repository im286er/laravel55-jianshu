<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Zan;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->withCount('comments', 'zans')->orderByDesc('created_at')->paginate(6);

        return view("posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        Auth::user()->posts()->create($request->only('title', 'content'));

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('comments.user', 'user');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->load('user');

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $this->authorize('update', $post);

        $post->update($request->only('title', 'content'));

        return redirect("posts/{$post->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // 用户的权限认证
        $this->authorize('update', $post);
        
        $post->delete();

        return redirect('posts');
    }

    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->store('posts');

        return asset('storage/' . $path);
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, [
            'content' => 'required|min:3'
        ]);

        $comment = $post->comments()->create($request->only('content'));
        Auth::user()->comments()->save($comment);

        return back();
    }

    public function zan(Post $post)
    {
        // 如果有就查找，没有就创建
        Zan::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();

        return back();
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required'
        ]);

        $query = request('query');
        $posts = Post::search($query)->paginate(20);

        return view('posts.search', compact('posts', 'query'));
    }
}
