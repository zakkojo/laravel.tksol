<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteContatto extends Model
{
    protected $table = 'cliente_contatto';

    public $timestamps = true;

    protected $fillable = [
        'cliente_id',
        'contatto_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function contatto()
    {
        return $this->belongsTo(Contatto::class);
    }
}
