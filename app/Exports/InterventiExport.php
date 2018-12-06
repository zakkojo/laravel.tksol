<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use DB;
use Html2Text\Html2Text;

class InterventiExport implements FromCollection, WithHeadings, WithTitle {
    public function __construct(array $filtri)
    {
        $this->filtri = $filtri;
    }

    public function title(): string
    {
        return 'Estrazione Interventi';
    }

    public function headings(): array
    {
        return [
            'intervento_id',
            'cliente_id',
            'contratto_id',
            'consulente_id',
            'data_intervento',
            'consulente_login',
            'progetto',
            'cliente',
            'origineFattura',
            'ore_lavorate',
            'ore_fatturare',
            'sede',
            'fatturabile',
            'attivita',
            'descrizione',
            'rimborso',
            'rimborso_tot',
            'km',
            'attivitaSvolte',
            'note',
            'approvato'
        ];
    }

    public function collection()
    {
        $filtro = $this->filtri;
        $dataset = DB::select("
        SELECT 
            i.id intervento_id,
            cli.id cliente_id,
            con.id contratto_id,
            cons.id consulente_id,
            date(i.data_Start) data_intervento,
            users.email consulente_login, 
            pro.nome progetto,
            cli.ragione_sociale cliente,						
            soc.nome origineFattura,				
            i.ore_lavorate ore_lavorate,
            i.ore_fatturate ore_fatturare,
            i.sede,
            i.fatturabile,
            att.descrizione attivita,
            ci.descrizione listino,
            GROUP_CONCAT(rim.tipo_spesa ORDER BY rim.id separator ', ') rimborso,
            SUM(rim.importo) rimborso_tot,
            SUM(IF(rim.um='Km', rim.quantita, null)) AS km,
            i.attivitaSvolte,
            i.note_fattura,
            i.approvato
            FROM laravel_tksol.intervento i 				
                        join users on(users.id = i.user_id)						
                            join consulente cons on(cons.user_id = users.id)			
                        join contratto_intervento conint on (i.listino_id = conint.id) 				
                            join contratto con on (conint.contratto_id = con.id) 			
                                join cliente cli on (con.cliente_id = cli.id)		
                                join cliente fat on (con.fatturazione_id = fat.id)				
                                join progetto pro on (con.progetto_id = pro.id)				
                                join societa soc on(con.societa_id = soc.id)				
                        join attivita att on (att.id = i.attivita_id)
                        join contratto_intervento ci on (ci.id = i.listino_id)
                        left join rimborsoIntervento rim ON (i.id = rim.intervento_id)
            WHERE date(i.data_Start) >= '{$filtro['data_start']}' AND date(i.data_Start) <= '{$filtro['data_end']}' 
            {$filtro['consulenti']}{$filtro['clienti']}
            AND i.deleted_at is null
            GROUP BY i.id 
        ");
        for ($i = 0, $c = count($dataset); $i < $c; ++$i) {
            $dataset[$i] = (array)$dataset[$i];
        }
        foreach ($dataset as $k => $array) {
            $dataset[$k]["attivitaSvolte"] = Html2Text::convert($dataset[$k]["attivitaSvolte"], true);
        }
        return collect($dataset);
    }
}