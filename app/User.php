<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 注册粉丝
     * @param $openid
     * @return void
     */
    public function insertUser($openid)
    {
        return $this->insertGetId([
            'openid' => $openid,
            'email' => $openid.'@gblog.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 获取用户名 By uid
     * @param $uid
     * @return mixed
     */
    public function getNameByUid($uid)
    {
        $user = $this->find($uid);
        return $user->name ?: $uid;
    }

    /**
     * 获取用户id By name
     * @param $name
     * @return mixed
     */
    public function getUidByName($name)
    {
        $user = $this->where('name', $name)->first();
        return $user ? $user->id : null;
    }
}
