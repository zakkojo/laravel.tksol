<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attivita extends Model {

	protected $table = 'attivita';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function subAttivitiva()
	{
		return $this->hasMany('Attivita', 'id_attivita');
	}

}