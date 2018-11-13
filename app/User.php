<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'tipo_utente',
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


    protected $dates = ['deleted_at'];

    public function consulente()
    {
        return $this->hasOne(Consulente::class);
    }

    public function interventi()
    {
        return $this->hasMany(Intervento::class);//->where('intervento.storico', 0);
    }

    public function contatto()
    {
        return $this->hasOne(Contatto::class);
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
        if (is_string($role)) {
            return $this->roles->contains($role,'name');
        }

        foreach ($role as $r) {
            if ($this->hasRole($r->name)) {
                return true;
            }
        }
        return false;
        //return !! $role->intersect($this->roles())->count();
    }
}
