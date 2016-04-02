<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContrattoIntervento extends Model {

	protected $table = 'contratto_intervento';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function contratto()
	{
		return $this->belongsTo('Contratto');
	}

	public function interventi()
	{
		return $this->hasMany('Intervento');
	}

}