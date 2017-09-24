<?php
//用户注册
Route::get('register', 'AuthController@showRegisterForm');
Route::post('register', 'AuthController@register');
// 用户登录
Route::get('login', 'AuthController@showLoginForm');
Route::post('login', 'AuthController@login');
// 登出行为
Route::get('logout', 'AuthController@logout');

// 个人资料编辑
Route::get('users/me/setting', 'UsersController@showSettingForm');
Route::put('users/me/setting', 'UsersController@setting');

// 文章列表页
Route::get('posts', 'PostsController@index');
// 创建文章
Route::get('posts/create', 'PostsController@create');
Route::post('posts', 'PostsController@store');
//搜索结果页
Route::get('posts/search', 'PostsController@search');
// 文章详情页
Route::get('posts/{post}', 'PostsController@show');
// 编辑文章
Route::get('posts/{post}/edit', 'PostsController@edit');
Route::put('posts/{post}', 'PostsController@update');
// 删除文章
Route::get('posts/{post}/delete', 'PostsController@destroy');
// 图片上传
Route::post('posts/image/upload', 'PostsController@imageUpload');
// 提交评论
Route::post('posts/{post}/comment', 'PostsController@comment');
// 点赞
Route::get('posts/{post}/zan', 'PostsController@zan');
// 取消赞
Route::get('posts/{post}/unzan', 'PostsController@unzan');

// 个人中心
Route::get('users/{user}', 'UsersController@show');
Route::post('users/{user}/fan', 'UsersController@fan');
Route::post('users/{user}/unfan', 'UsersController@unfan');

// 专题详请页
Route::get('topics/{topic}', 'TopicsController@show');
Route::post('topics/{topic}/submit', 'TopicsController@submit');

// 后台路由
include_once('admin.php');












