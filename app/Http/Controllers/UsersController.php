<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function showSettingForm()
    {
        return view('users.me.setting');
    }

    public function setting(Request $request)
    {
        dd($request);
    }

    // 个人中心页面
    public function show(User $user)
    {
    	// 用户信息，包含关注／粉丝／文章数
    	$user = User::withCount('stars', 'posts', 'fans')->find($user->id);

   		// 文章列表，取创建时间的前10条
   		$posts = $user->posts()->orderByDesc('created_at')->take(10)->get();

   		// 粉丝用户
   		$fusers = User::whereIn('id', $user->fans->pluck('fan_id'))
   				->withCount('stars', 'posts', 'fans')->get();

   		// 关注的用户
   		$susers = User::whereIn('id', $user->stars->pluck('star_id'))
   				->withCount('stars', 'posts', 'fans')->get();

        return view('users.show', compact('user', 'posts', 'susers', 'fusers'));
    }

    // 关注
    public function fan(User $user)
    {
    	Auth::user()->doFan($user->id);

        return [
        	'error' => 0,
        	'message' => ''
        ];
    }

    // 取消关注
    public function unfan(User $user)
    {
    	Auth::user()->doUnfan($user->id);

        return [
        	'error' => 0,
        	'message' => ''
        ];
    }
}
