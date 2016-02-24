<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model {

	protected $table = 'cliente';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function rubrica()
	{
		return $this->hasMany('Contatto', 'id_cliente');
	}

}