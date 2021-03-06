<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContrattoIntervento extends Model {

    protected $table = 'contratto_intervento';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'contratto_id',
        'descrizione',
        'tariffa_ora',
        'iva',
        'tipo_iva',
        'ore_previste',
    ];

    public function contratto()
    {
        return $this->belongsTo(Contratto::class);
    }

    public function interventi()
    {
        return $this->hasMany(Intervento::class, 'listino_id', 'id');
    }

    public function interventi_wt()
    {
        return $this->hasMany('App\Intervento', 'listino_id', 'id')->withTrashed();
    }
}
