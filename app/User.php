<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    protected $table = 'users';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function consulente()
    {
        return $this->hasOne('Consulente');
    }

    public function cliente()
    {
        return $this->hasOne('Contatto');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function hasRole($role)
    {
        if (is_string($role)){
            return $this->roles->contains('name', $role);
        }

        foreach ($role as $r){
            if ($this->hasRole($r->name)) {
                return true;
            }
        }
        return false;
        //return !! $role->intersect($this->roles())->count();
    }

}