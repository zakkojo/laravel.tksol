<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulente extends Model {

    protected $table = 'consulente';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'codice_fiscale', 'cognome', 'nome', 'indirizzo', 'citta', 'provincia', 'cap', 'telefono', 'mobile', 'telefono2', 'mobile2', 'partita_iva', 'tipo','rapportino','ripianifica',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function interventi()
    {
        return $this->user->interventi();
    }

    public function getNominativoAttribute()
    {
        return $this->nome . ' ' . $this->cognome;
    }

    public function contratti()
    {
        return $this->belongsToMany(Contratto::class)->with('progetto')->withPivot('note', 'ruolo')->where('contratto.stato','<>','CLOSED');
    }

    public function capoProgetto()
    {
        return $this->belongsToMany(Contratto::class)->withPivot('note', 'ruolo')->where('ruolo', 'Capo Progetto')->where('contratto.stato','<>','CLOSED');
    }

    public function canPianificare($contratto_id)
    {
        if ($this->contratti->where('id', $contratto_id)->count() > 0)
            return true;
        else
            return false;
    }
}