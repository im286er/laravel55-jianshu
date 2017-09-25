<?php 

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\AdminUser;

class UsersController extends Controller 
{
	public function index()
	{
		$admins = AdminUser::paginate(10);

	    return view('admin.users.index', compact('admins'));
	}

	public function create()
	{
	    return view('admin.users.create');
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	    	'name' => 'required|min:2|unique:admin_users,name',
	    	'password' => 'required|min:6|max:12'
	    ]);

	    AdminUser::create([
	    	'name' => request('name'),
	    	'password' => bcrypt(request('password'))
	    ]);

	    return redirect('admin/users');
	}
}