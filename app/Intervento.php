<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervento extends Model {

	protected $table = 'intervento';
	public $timestamps = false;



	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function attivita()
	{
		return $this->belongsTo('Attivita');
	}

	public function consulente()
	{
		return $this->belongsTo('Consulente');
	}

	public function listinoInterventi()
	{
		return $this->belongsTo('ContrattoIntervento');
	}

    public function rimborsi()
    {
        return $this->hasMany('RimborsoIntervento');
    }
}