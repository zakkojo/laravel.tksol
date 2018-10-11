<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodiceCliente extends Model {

	protected $table = 'codiceCliente';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class);
	}

}