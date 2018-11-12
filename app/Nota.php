<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    protected $table = 'note';

    public $timestamps = true;

    use SoftDeletes;

    public function annotazione()
    {
        return $this->morphTo();
    }
}
