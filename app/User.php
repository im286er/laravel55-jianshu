<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 用户的文章列表
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    // 用户的评论
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // 关注我的Fan模型
    public function fans()
    {
        return $this->hasMany('App\Fan', 'star_id', 'id');
    }

    // 我关注的Fan模型
    public function stars()
    {
        return $this->hasMany('App\Fan', 'fan_id', 'id');
    }

    // 关注某人
    public function doFan($uid)
    {
        $fan = new \App\Fan;
        $fan->star_id = $uid;

        return $this->stars()->save($fan);
    }

    // 取消关注
    public function doUnfan($uid)
    {
        $fan = new \App\Fan;
        $fan->star_id = $uid;

        return $this->stars()->delete($fan);
    }

    // 当前用户是否被uid关注了
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    // 当前用户是否关注了UID
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id', $uid)->count();
    }

}









