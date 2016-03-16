<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attivita extends Model {

	protected $table = 'attivita';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'descrizione',
    ];

    public function progetto()
    {
        return $this->hasOne($this, 'attivita_padre');
    }

	public function padre()
	{
		return $this->belongsTo($this,'attivita_padre');
	}

	public function figli()
	{
		return $this->hasMany($this, 'attivita_padre');
	}

}