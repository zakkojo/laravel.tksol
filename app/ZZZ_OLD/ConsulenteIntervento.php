<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsulenteIntervento extends Model {

	protected $table = 'consulenteIntervento';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function consulente_anagrafica()
	{
		return $this->hasOne('Consulente', 'id_consulente');
	}

}