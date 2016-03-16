<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contratto extends Model
{
    protected $table = 'contratto';
    public $timestamps = true;

    protected $fillable = [
        'note',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function progetto()
    {
        return $this->belongsTo(Progetto::class)->where('progetto_padre', 0);
    }

    }
