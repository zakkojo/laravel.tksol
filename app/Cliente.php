<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model {

	protected $table = 'cliente';
	public $timestamps = true;

	protected $fillable = [
		'codice_fiscale','partita_iva','ragione_sociale','indirizzo','citta','provincia','cap','telefono','rating','cliente','settore','softwarehouse',
	];

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function rubrica()
	{
		return $this->hasMany(Contatto::class);
	}

	public function progettiAssociati()
	{
		return $this->hasMany('Progetto')->where('progetto_padre', 0);
	}

	public function contratti(){
		return $this->hasMany(Contratto::class);
	}

}