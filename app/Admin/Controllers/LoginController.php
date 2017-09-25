<?php 

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller 
{
	public function index()
	{
	    return view('admin.login.index');
	}

	public function login(Request $request)
	{
        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:6|max:12',
        ]);

        if(Auth::guard('admin')->attempt($request->only('name', 'password'))) {
            return redirect('/admin/home');
        }

        return back()->withErrors('用户名密码不正确');
	}

	public function logout()
	{
	    Auth::guard('admin')->logout();

	    return redirect('admin/login');
	}
}