<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contatto extends Model
{

    protected $table = 'contatto';
    public $timestamps = true;

    protected $fillable = [
        'cliente_id','descrizione','email','indirizzo','citta','provincia','cap','telefono','telefono2','fax','ruolo',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function clienti()
    {
        return $this->belongsToMany(Cliente::class,'cliente_contatto','contatto_id','cliente_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
