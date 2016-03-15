<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulente extends Model {

	protected $table = 'consulente';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	protected $fillable = [
		'codice_fiscale','cognome','nome','indirizzo','citta','provincia','cap','telefono','mobile','telefono2','mobile2','partita_iva','tipo',
	];

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}