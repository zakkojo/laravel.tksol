<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RimborsoIntervento extends Model {

	protected $table = 'rimborsoIntervento';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function rimborso()
	{
		return $this->hasOne('ConsulenteIntervento', 'id_intervento', 'id_consulente');
	}

}