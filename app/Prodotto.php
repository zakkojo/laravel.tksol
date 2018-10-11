<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodotto extends Model {

    protected $table = 'prodotto';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome',
        'codice',
    ];

    public function listinoProdotto()
    {
        return $this->hasMany('ContrattoProdotto');
    }

}