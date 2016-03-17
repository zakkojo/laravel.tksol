<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Attivita extends Model {

	protected $table = 'attivita';
	public $timestamps = true;

	use SoftDeletes;
    use NodeTrait;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'descrizione','progetto_id',
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