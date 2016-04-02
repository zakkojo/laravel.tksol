<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class ContrattoProdotto extends Model {

	protected $table = 'contratto_prodotto';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'contratto_id',
        'prodotto_id',
        'softwarehouse_id',
        'importo',
        'iva',
        'tipo_iva',
        'fee',
        'tipo_vendita',
        'scadenza',
    ];

    public function setScadenzaAttribute($date)
    {
        if($date != "") $this->attributes['scadenza'] = Carbon::createFromFormat('d/m/Y', $date);
        else $this->attributes['scadenza'] = NULL;
    }
    public function getScadenzaAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

	public function softwarehouse()
	{
		return $this->belongsTo(Cliente::class,'softwarehouse_id');
	}

	public function prodotto()
	{
		return $this->belongsTo(Prodotto::class);
	}

	public function contratto()
	{
		return $this->belongsTo(Contratto::class);
	}

}