<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Societa extends Model
{
    protected $table = 'societa';
    public $timestamps = true;

    protected $fillable = [
    ];

    protected $nullable = [
    ];
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    public function contratti(){
        return $this->hasMany(Contratto::class);
    }
}
