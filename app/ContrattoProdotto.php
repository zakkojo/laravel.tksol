<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContrattoProdotto extends Model {

	protected $table = 'contratto_prodotto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function prodotto()
	{
		return $this->hasOne('Prodotto');
	}

	public function contratto()
	{
		return $this->belongsTo('Contratto');
	}

}