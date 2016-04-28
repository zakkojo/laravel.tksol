<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsulenteContratto extends Model
{
    protected $table = 'consulente_contratto';

    protected $fillable = [
        'contratto_id',
        'consulente_id',
        'ruolo',
        'note',
    ];

    public function contratto()
    {
        return $this->belongsTo(Contratto::class);
    }

    public function consulente()
    {
        return $this->belongsTo(Consulente::class);
    }
}
