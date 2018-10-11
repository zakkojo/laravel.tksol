<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rimborso extends Model {

	protected $table = 'rimborsoIntervento';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $fillable = [
        'tipo_spesa',
        'um',
        'quantita',
        'importo',
        'intervento_id',
    ];

	public function intervento()
	{
		return $this->belongsTo('Intervento');
	}

}