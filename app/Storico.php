<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storico extends Model
{
    protected $table = 'storico';

    public $timestamps = false;

    public function storicizza()
    {
        return $this->morphTo();
    }
}
