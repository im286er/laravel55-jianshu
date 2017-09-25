<?php 

/*
|--------------------------------------------------------------------------
| 后台路由
|--------------------------------------------------------------------------
| 在App\Providers\RouteServiceProvider 定义路由文件，命名空间，路由前缀
*/

// 显示登录表单页
Route::get('login', 'LoginController@index');
// 登录行为
Route::post('login', 'LoginController@login');
// 登出行为
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' => 'auth:admin'], function () {
	// 首页
	Route::get('home', 'HomeController@index');
	// 管理人员模块
	Route::get('users', 'UsersController@index');
	Route::get('users/create', 'UsersController@create');
	Route::post('users/store', 'UsersController@store');

    // 审核模块
    Route::get('posts', 'PostsController@index');
    Route::post('posts/{post}/status', 'PostsController@status');
});