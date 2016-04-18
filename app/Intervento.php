<?php

namespace App;

use App\ContrattoIntervento;
use App\Contratto;

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
    ];

    public function attivita()
    {
        return $this->belongsTo(Attivita::class);
    }

    public function consulente()
    {
        return $this->belongsTo(Consulente::class);
    }

    public function listinoInterventi()
    {
        return $this->belongsTo(ContrattoIntervento::class, 'listino_id', 'id');
    }

    public function rimborsi()
    {
        return $this->hasMany(RimborsoIntervento::class);
    }

}