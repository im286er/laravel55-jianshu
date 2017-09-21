<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
	/**
	 * 显示注册表单页
	 */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * 注册行为
     * @param  Request $request
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6|max:12|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('login');
    }

    /**
     * 显示登录的表单页
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * 登录行为
     * @param  Request $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|email',
            'password' => 'required|min:6|max:12',
            'is_remember' => 'integer'
        ]);

        if(Auth::attempt($request->only('email', 'password'), $request->is_remember)) {
            return redirect('posts');
        }

        return back()->withErrors('邮箱或密码不正确');
    }

    // 用户登出行为
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
