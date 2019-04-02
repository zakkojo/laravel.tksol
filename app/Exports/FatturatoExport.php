<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use DB;

class FatturatoExport implements FromCollection, WithHeadings, WithTitle {

    public function __construct(array $filtri)
    {
        $this->filtri = $filtri;
    }

    public function title(): string
    {
        return 'fatturato';
    }

    public function headings(): array
    {
        return [
            'intervento_id',
            'dst_fatturazione_id',
            'src_fatturazione_id',
            'cliente_id',
            'contratto_id',
            'consulente_id',
            'data_intervento',
            'consulente_login',
            'progetto',
            'cliente',
            'destinazioneFattura',
            'origineFattura',
            'attivitaSvolte',
            'ore_lavorate',
            'ore_fatturare',
            'sede',
            'fatturabile',
            'n_fattura',
            'data_fattura',
            'note'

        ];
    }

    public function collection()
    {
        $filtro = $this->filtri;
        $dataset = DB::select("
        SELECT  
            i.id intervento_id,				
            fat.id dst_fatturazione_id,				
            soc.id src_fatturazione_id,				
            cli.id cliente_id,				
            con.id contratto_id,				
            cons.id consulente_id,				
            date(i.data_Start) data_intervento,				
            users.email consulente_login,				
            pro.nome progetto,				
            cli.ragione_sociale cliente,				
            fat.ragione_sociale destinazioneFattura,				
            soc.nome origineFattura,				
            i.attivitaSvolte,			
            i.ore_lavorate ore_lavorate,
            i.ore_fatturate ore_fatturare,
            i.sede,
            i.fatturabile,
            i.fatturato N_Fattura,
            DATE_FORMAT(i.data_fattura, '%d/%m/%Y')data_fattura,
            i.note_fattura
        FROM laravel_tksol.intervento i 				
        JOIN users ON(users.id = i.user_id)						
            JOIN consulente cons ON(cons.user_id = users.id)			
        JOIN contratto_intervento conint ON (i.listino_id = conint.id) 				
            JOIN contratto con ON (conint.contratto_id = con.id) 			
                JOIN cliente cli ON (con.cliente_id = cli.id)		
                JOIN cliente fat ON (con.fatturazione_id = fat.id)				
                JOIN progetto pro ON (con.progetto_id = pro.id)				
                JOIN societa soc ON(con.societa_id = soc.id)				
        JOIN attivita att ON (att.id = i.attivita_id)
        JOIN contratto_intervento ci ON (ci.id = i.listino_id)
        WHERE 
        i.deleted_at IS NULL "
            .  $filtro['wfatture'] . $filtro['wdi'] . $filtro['wdf'] .  $filtro['wfiltro'] . ' ORDER BY i.data_start DESC');

        return collect($dataset);
    }
}
