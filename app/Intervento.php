<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervento extends Model {

	protected $table = 'intervento';
	public $timestamps = false;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function intervento_progetto()
	{
		return $this->morphOne('Attivita', 'id_attivita');
	}

	public function intervento_progetto()
	{
		return $this->belongsTo('ProgettoCliente', 'id_cliente', 'id_progetto');
	}

	public function consulenti()
	{
		return $this->hasMany('ConsulenteIntervento', 'id_intervento');
	}

	public function tipo()
	{
		return $this->belongsTo('TipoIntervento', 'id_tipo_intervento');
	}

}