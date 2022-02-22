<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgettoCliente extends Model
{

    protected $table = 'progettoCliente';
    public $timestamps = false;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function stato_cliente()
    {
        return $this->hasOne('Cliente', 'id_cliente');
    }

    public function stato_progetto()
    {
        return $this->hasOne('Progetto', 'id_progetto');
    }
}
