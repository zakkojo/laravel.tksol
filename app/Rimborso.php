<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rimborso extends Model {

	protected $table = 'rimborsoIntervento';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function intervento()
	{
		return $this->belongsTo('Intervento');
	}

}