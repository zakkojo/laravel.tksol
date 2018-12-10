<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Intervento;

class FattureGammaImport implements ToCollection, WithCustomCsvSettings, WithStartRow {

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $intervento = Intervento::find($row[3]);
            if ($intervento)
            {
                $errore = 0;
                if ($row[0] == 'HTK-C-PREFAT')
                {
                    $errore = 1;
                    //campo esito = Riga Scartata
                }

                if ($errore == 0)
                {
                    $data_fattura = Carbon::createFromFormat('d/m/Y', $row[2])->setTime(0, 0, 0);
                    $intervento->data_fattura = $data_fattura;
                    $intervento->fatturato = $row[1];
                    $intervento->save();
                }
            }
            //else esito = Intervento non trovato
        }
    }

    public
    function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public
    function startRow(): int
    {
        return 1;
    }
}
