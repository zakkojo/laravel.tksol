<?php

namespace App;

use App\ContrattoIntervento;
use App\Contratto;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervento extends Model {

    protected $table = 'intervento';
    public $timestamps = false;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'listino_id',
        'attivita_id',
        'consulente_id',
        'data_start',
        'data_end',
        'attivitaPianificate',
        'creatore_id',
        'data_modifica',
        'data_accettazione',
    ];

    public function getOrarioAttribute()
    {
        return Carbon::parse($this->data_start)->format('H:i') . ' - ' . Carbon::parse($this->data_end)->format('H:i');
    }

    public function getDataAttribute()
    {
        return Carbon::parse($this->data_start)->format('d/m/Y');
    }
    public function getDataCAttribute()
    {
        return Carbon::parse($this->data_start)->format('Y-m-d');
    }

    public function attivita()
    {
        return $this->belongsTo(Attivita::class);
    }

    public function consulente()
    {
        return $this->belongsTo(Consulente::class);
    }
    public function creatore()
    {
        return $this->belongsTo(Consulente::class,'consulente_id','id');
    }


    public function listinoInterventi()
    {
        return $this->belongsTo(ContrattoIntervento::class, 'listino_id', 'id');
    }
    public function listinoInterventi_wt()
    {
        return $this->belongsTo(ContrattoIntervento::class, 'listino_id', 'id')->withTrashed();
    }

    public function rimborsi()
    {
        return $this->hasMany(Rimborso::class);
    }

}