<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

	protected $table = 'users';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function consulente()
	{
		return $this->hasOne('Consulente');
	}

	public function cliente()
	{
		return $this->hasOne('Contatto');
	}

}