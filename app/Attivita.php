<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attivita extends Model
{

    protected $table = 'attivita';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'descrizione', 'progetto_id', 'parent_id', '_rgt', '_lft',
    ];


    public function progetto()
    {
        return $this->belongsTo(Progetto::class);
    }

    public static function getDataTree($progetto_id)
    {
        function traverse($collection)
        {
            foreach ($collection as $attivita) {
                $attivita['text'] = $attivita['descrizione'];
                //if (count($attivita['children'])) {
                //    $attivita['nodes'] = traverse($attivita['children']);
                //}
            }
            return $collection;
        }

        $attivita = Attivita::where(['progetto_id' => $progetto_id])->get();    
        $listAttivita = traverse($attivita);
        return $listAttivita;
    }
}
