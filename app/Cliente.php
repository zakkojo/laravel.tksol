<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Cliente extends Model {

	protected $table = 'cliente';
	public $timestamps = true;

	protected $fillable = [
		'codice_fiscale','partita_iva','ragione_sociale','indirizzo','citta','provincia','cap','telefono','fax','email','rating','cliente','settore','softwarehouse','distanza',
	];

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    static function getSoftwarehouse()
    {
        return Cliente::where('softwarehouse','=','1')->get();
	}

    //Mutator per update field a null
	public function setRatingAttribute($target){
		$this->attributes['rating'] = $target ?: null;
	}
    public function setDistanzaAttribute($target){
        $this->attributes['distanza'] = $target ?: null;
    }
    // fine mutators 0 AND '' to null

	public function rubrica()
	{
		return $this->hasMany(Contatto::class);
	}

    public function contratti(){
        return $this->hasMany(Contratto::class);
    }

    public function contrattiAttivi(){
        return $this->hasMany(Contratto::class)->where('stato','<>','CLOSED');
    }
    public function contrattiScaduti(){
        return $this->hasMany(Contratto::class)->where('stato','CLOSED');
    }

}