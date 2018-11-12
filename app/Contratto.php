<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Input;

class Contratto extends Model
{

    protected $table = 'contratto';
    public $timestamps = true;

    protected $fillable = [
        'societa_id',
        'cliente_id',
        'progetto_id',
        'stato',
        'importo',
        'modalita_fattura',
        'periodicita_pagamenti',
        'note',
        'data_primo_contatto',
        'data_validita_contratto',
        'data_avvio_progetto',
        'data_chiusura_progetto',
        'rimborsi',
        'fatturazione_id',
        'ripianifica',
        'rapportino',
        'fatturazione_default',
    ];

    protected $nullable = [
    ];
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];


    public function setDataPrimoContattoAttribute($date)
    {
        $this->attributes['data_primo_contatto'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function setDataValiditaContrattoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_validita_contratto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_validita_contratto'] = null;
        }
    }

    public function setDataAvvioProgettoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_avvio_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_avvio_progetto'] = null;
        }
    }

    public function setDataChiusuraProgettoAttribute($date)
    {
        if ($date != "") {
            $this->attributes['data_chiusura_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        } else {
            $this->attributes['data_chiusura_progetto'] = null;
        }
    }

    public function getDataPrimoContattoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataValiditaContrattoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataAvvioProgettoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function getDataChiusuraContrattoAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function societa()
    {
        return $this->belongsTo(Societa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function fatturazione()
    {
        return $this->belongsTo(Cliente::class)->where('softwarehouse', '1'); //where come controllo?!?
    }

    public function progetto()
    {
        return $this->belongsTo(Progetto::class);
    }

    public function consulenti()
    {
        return $this->belongsToMany(Consulente::class)->withPivot('note', 'ruolo');
    }

    public function listinoProdotti()
    {
        return $this->hasMany(ContrattoProdotto::class);
    }

    public function listinoInterventi()
    {
        return $this->hasMany(ContrattoIntervento::class);
    }

    public function prossimiInterventi()
    {
        return $this->hasMany(Intervento::class)->whereDate('data_start', '>', date('Y-m-d'));
    }

    public function interventi()
    {
        return $this->hasMany(Intervento::class);
    }

    public function interventiDaApprovare()
    {
        return $this->hasMany(Intervento::class)->where('approvato', '0')->where('fatturabile', '1');
    }
}
