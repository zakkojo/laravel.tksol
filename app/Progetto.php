<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progetto extends Model {

	protected $table = 'progetto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function delivery()
	{
		return $this->hasMany('Attivita', 'id_progetto');
	}

}