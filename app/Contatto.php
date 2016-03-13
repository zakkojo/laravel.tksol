<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contatto extends Model {

	protected $table = 'contatto';
	public $timestamps = true;

	protected $fillable = [
		'codice_fiscale','cognome','nome','indirizzo','citta','provincia','cap','telefono','mobile','partita_iva','tipo',
	];

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}