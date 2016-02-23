<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contatto extends Model {

	protected $table = 'contatto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}