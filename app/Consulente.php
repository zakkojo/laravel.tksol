<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulente extends Model {

	protected $table = 'consulenti';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}