<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contratto extends Model {

    protected $table = 'contratto';
    public $timestamps = true;

    protected $fillable = [
        'cliente_id',
        'progetto_id',
        'capo_progetto',
        'stato',
        'importo',
        'modalita_fattura',
        'periodicita_pagamenti',
        'note',
        'data_primo_contatto',
        'data_validita_contratto',
        'data_avvio_progetto',
        'data_chiusura_progetto',
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
        if($date != "") $this->attributes['data_validita_contratto'] = Carbon::createFromFormat('d/m/Y', $date);
        else $this->attributes['data_validita_contratto'] = NULL;
    }

    public function setDataAvvioProgettoAttribute($date)
    {
        if($date != "") $this->attributes['data_avvio_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        else $this->attributes['data_avvio_progetto'] = NULL;
    }

    public function setDataChiusuraProgettoAttribute($date)
    {
        if($date != "") $this->attributes['data_chiusura_progetto'] = Carbon::createFromFormat('d/m/Y', $date);
        else $this->attributes['data_chiusura_progetto'] = NULL;
    }

    public function getDataPrimoContattoAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataValiditaContrattoAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataAvvioProgettoAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataChiusuraContrattoAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function progetto()
    {
        return $this->belongsTo(Progetto::class)->where('progetto_padre', 0);
    }

}
