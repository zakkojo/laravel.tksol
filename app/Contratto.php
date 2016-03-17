<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contratto extends Model {

    protected $table = 'contratto';
    public $timestamps = true;

    protected $fillable = [
        'note',
        'data_primo_contatto',
        'data_validita_contratto',
        'data_avvio_progetto',
        'data_chiusura_progetto',
    ];

    protected $nullable = [
        'data_validita_contratto',
        'data_avvio_progetto',
        'data_chiusura_progetto',
    ];
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];


    public function setDataPrimoContattoAttribute($date)
    {
        if ($date!="") $this->attributes['data_primo_contatto'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function setDataValiditaContratto($date)
    {
        $this->attributes['data_validita_contratto'] = Carbon::createFromFormat('d/m/Y', $date);

    }

    public function setDataAvvioProgetto($date)
    {
        $this->attributes['data_avvio_progetto'] = null;

    }

    public function setDataChiusuraContratto($date)
    {
        $this->attributes['data_chiusura_contratto'] = null;
    }

    public function getDataPrimoContattoAttribute($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataValiditaContratto($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataAvvioProgetto($date)
    {
        if ($date) return Carbon::parse($date)->format('d/m/Y');
        else return null;
    }

    public function getDataChiusuraContratto($date)
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
