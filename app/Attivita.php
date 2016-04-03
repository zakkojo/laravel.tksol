<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Attivita extends Model {

    protected $table = 'attivita';
    public $timestamps = true;

    use SoftDeletes;
    use NodeTrait;

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
        Attivita::where(['progetto_id' => $progetto_id])->fixTree();
        $attivitas = Attivita::where(['progetto_id' => $progetto_id])->defaultOrder()->get()->toTree();

        function traverse($collection)
        {
            foreach ($collection as $attivita)
            {
                $attivita['text'] = $attivita['descrizione'];
                if (count($attivita['children'])) $attivita['nodes'] = traverse($attivita['children']);
            }

            return $collection;
        }
        $listAttivita = traverse($attivitas);
        return $listAttivita;
    }


}