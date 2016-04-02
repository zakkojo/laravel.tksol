<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListinoProgetto extends Model {

	protected $table = 'listinoProgetto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function listino_progetto()
	{
		return $this->hasOne('ProgettoCliente');
	}

	public function cliente()
	{
		return $this->hasOne('Cliente', 'id_cliente');
	}

}