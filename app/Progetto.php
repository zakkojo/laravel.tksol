<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Progetto extends Model {

	protected $table = 'progetto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'area','nome',
    ];

	public function delivery()
	{
		return $this->hasMany(Attivita::class)->where('attivita_padre', 0);
	}

	public function padre()
	{
		return $this->belongsTo($this,'progetto_padre');
	}

    public function figli()
    {
        return $this->hasMany($this, 'progetto_padre');
    }

}

