<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contatto extends Model {

	protected $table = 'contatto';
	public $timestamps = true;

	protected $fillable = [
		'cliente_id','descrizione','email','email2','indirizzo','citta','provincia','cap','telefono','mobile','telefono2','mobile2',
	];

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}