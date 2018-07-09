<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteSocieta extends Model
{
    protected $table = 'cliente_societa';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'societa_id',
        'idGamma',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function societa()
    {
        return $this->belongsTo(Societa::class);
    }
}
