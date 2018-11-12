<?php

namespace App;

use App\ContrattoIntervento;
use App\Contratto;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Intervento extends Model
{

    protected $table = 'intervento';
    public $timestamps = true;

    use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'listino_id',
        'attivita_id',
        'consulente_id',
        'data_start',
        'data_end',
        'attivitaPianificate',
        'creatore_id',
        'data_modifica',
        'fatturabile',
    ];

    public function storico()
    {
        return $this->morphMany('App\Storico', 'storicizza');
    }

    public function getStorico()
    {
        return $this::where('id', $this->id)->orderBy('id', 'DESC')->get();
    }

    public function getOrarioAttribute()
    {
        return Carbon::parse($this->data_start)->format('H:i') . ' - ' . Carbon::parse($this->data_end)->format('H:i');
    }
    public function getOraInizioAttribute()
    {
        return Carbon::parse($this->data_start)->format('H:i');
    }
    public function getOraFineAttribute()
    {
        return Carbon::parse($this->data_end)->format('H:i');
    }
    public function getDataAttribute()
    {
        return Carbon::parse($this->data_start)->format('d/m/Y');
    }

    public function getDataCAttribute()
    {
        return Carbon::parse($this->data_start)->format('Y-m-d');
    }
    public function getDatafAttribute()
    {
        if ($this->data_fattura) {
            return Carbon::parse($this->data_fattura)->format('d/m/Y');
        } else {
            return null;
        }
    }

    public function attivita()
    {
        return $this->belongsTo(Attivita::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_modifica()
    {
        return $this->belongsTo(User::class, 'user_id_modifica', 'id');
    }

    public function listinoInterventi()
    {
        return $this->belongsTo(ContrattoIntervento::class, 'listino_id', 'id');
    }


    public function listinoInterventi_wt()
    {
        return $this->belongsTo(ContrattoIntervento::class, 'listino_id', 'id')->withTrashed();
    }
    public function contratto()
    {
        return $this->belongsTo(Contratto::class);
    }

    public function rimborsi()
    {
        return $this->hasMany(Rimborso::class);
    }
}
