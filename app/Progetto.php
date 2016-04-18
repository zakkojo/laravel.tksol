<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progetto extends Model {

	protected $table = 'progetto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'area','nome', 'codice',
    ];

    
	public function attivita()
	{
		return $this->hasMany(Attivita::class);
	}

    public function contratti()
    {
        return $this->hasMany(Contratto::class);
    }

    public function getDescrizioneAttribute()
    {
        return $this->area.' / '.$this->nome;
	}

}

