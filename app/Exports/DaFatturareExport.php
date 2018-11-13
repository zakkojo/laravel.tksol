<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use DB;
use Html2Text\Html2Text;

class DaFatturareExport implements FromCollection, WithHeadings, WithTitle {

    public function title(): string
    {
        return 'Da Fatturare al ' . Carbon::now()->format('d-m-Y');
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
            'fatturabile'
        ];
    }

    public function collection()
    {
        $daFatturare = DB::select("
        SELECT 				
            inter.id intervento_id,				
            fat.id dst_fatturazione_id,				
            soc.id src_fatturazione_id,				
            cli.id cliente_id,				
            con.id contratto_id,				
            cons.id consulente_id,				
            date(inter.data_Start) data_intervento,				
            users.email consulente_login,				
            pro.nome progetto,				
            cli.ragione_sociale cliente,				
            fat.ragione_sociale destinazioneFattura,				
            soc.nome origineFattura,				
            inter.attivitaSvolte,			
            inter.ore_lavorate ore_lavorate,
            inter.ore_fatturate ore_fatturare,
            inter.sede,
            inter.fatturabile " .
//            '',
//            '' as 'Numero Fattura',
//            '' as 'Data Fattura',
//            '' as 'Note Fattura'
            "FROM 				
            laravel_tksol.intervento inter 				
            join users on(users.id = inter.user_id)						
	            join consulente cons on(cons.user_id = users.id)			
            join contratto_intervento conint on (inter.listino_id = conint.id) 				
                join contratto con on (conint.contratto_id = con.id) 			
                    join cliente cli on (con.cliente_id = cli.id)		
                    join cliente fat on (con.fatturazione_id = fat.id)				
                    join progetto pro on (con.progetto_id = pro.id)				
                    join societa soc on(con.societa_id = soc.id)				
            join attivita att on (att.id = inter.attivita_id)
        where inter.approvato=1
        and inter.ore_fatturate <> 0
        and inter.fatturabile =1
        and (inter.fatturato is null or inter.data_fattura is null)
        ");
        for ($i = 0, $c = count($daFatturare); $i < $c; ++$i) {
            $daFatturare[$i] = (array)$daFatturare[$i];
        }

        foreach ($daFatturare as $k => $array) {
            $daFatturare[$k]["attivitaSvolte"] = Html2Text::convert($daFatturare[$k]["attivitaSvolte"], true);
        }

        return collect($daFatturare);
    }
}