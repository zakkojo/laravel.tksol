<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allegato extends Model
{
    protected $table = 'allegati';

    public $timestamps = true;
    use SoftDeletes;

    public function allega()
    {
        return $this->morphTo();
    }
}