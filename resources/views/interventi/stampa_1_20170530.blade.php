<style>
    * {
        font-family: segoe ui;
    }

    body {
        height: 29.7cm;
        width: 22cm;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .bold {
        font-weight: bold;
    }

    div#rapportino {
        margin: 1cm;
        height: 27.7cm;
        width: 20cm;
        border: 0pt solid grey;
        padding: 0.5cm;
    }

    div#logo {
        position: absolute;
        top: 1cm;
        left: 1.5cm;
        height: 4cm;
        width: 4cm;
    }

    div#intestazione {
        position: absolute;
        top: 1.5cm;
        left: 7cm;
        height: 3cm;
        width: 14cm;
        overflow: hidden;
    }

    div#intestazione span.main {
        font-size: 15pt;
        font-weight: bold;
        line-height: 0.8cm;
    }

    div#intestazione span.sub {
        font-size: 9pt;
        line-height: 0.5cm;
    }

    div#infoCliente {
        position: absolute;
        top: 4.5cm;
        left: 1.5cm;
        height: 3.5cm;
        width: 9.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#infoCliente div {
    }

    div#infoConsulente {
        position: absolute;
        top: 4.5cm;
        left: 11.5cm;
        height: 3.5cm;
        width: 9.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#infoConsulente div {
    }

    div#infoContratto {
        position: absolute;
        top: 8.5cm;
        left: 1.5cm;
        height: 1.8cm;
        width: 9.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#infoContratto div {
    }

    div#infoRapportino {
        position: absolute;
        top: 8.5cm;
        left: 11.5cm;
        height: 1.8cm;
        width: 9.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#infoRapportino div {
    }

    div#testo {
        position: absolute;
        top: 11cm;
        left: 1.5cm;
        height: 16.5cm;
        border: 1px solid;
        overflow: hidden;
    }

    div#attivitaPianificate {
        left: 1.5cm;
        width: 19.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#attivitaSvolte {
        left: 1.5cm;
        width: 19.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#attivitaInCaricoCliente {
        left: 1.5cm;
        width: 19.5cm;
        height: 5cm;
        padding: 0.2cm;
    }

    div#attivitaProgrammate {
        left: 1.5cm;
        width: 19.5cm;
        border: 1pt solid grey;
        padding: 0.2cm;
    }

    div#firmaConsulente {
        position: absolute;
        top: 28cm;
        left: 1.5cm;
        height: 1.2cm;
        width: 8cm;
        border-bottom: 1pt solid grey;
        padding: 0.2cm;
    }

    div#firmaCliente {
        position: absolute;
        top: 28cm;
        left: 11cm;
        height: 1.2cm;
        width: 8cm;
        border-bottom: 1pt solid grey;
        padding: 0.2cm;
    }

    div#titolo {
        text-align: right;
        background-color: #ffffff;
        font-size: 8pt;
        font-weight: bold;
        margin: -0.15cm;
        padding: 0.05cm;
        color: #bfbfbf;
    }
</style>
<html>
<body>

<div id='rapportino'>
    <div id='testata'>
        <div id="logo">
            <img src='<?=public_path()?>/img/teikos_solutions.gif'>
        </div>
        <div id="intestazione">
            <span class='main'>TEIKOS SOLUTIONS s.r.l </span><br/>
            <span class='sub'>Sede legale e uffici: Via A. Gordini n. 3 | 47122 Forl&igrave; | www.tksol.net | PIVA CF 03349380406 - C.C.I.A.A. 296802<br/>+39 0543.796018 | solutions@teikos
                .it<br/></span>
        </div>
    </div>
    <div id='infoCliente'>
        <div id='titolo'>DATI CLIENTE</div>
        <div class='bold'>{{$intervento->contratto->cliente->ragione_sociale}}</div>
        <div>{{$intervento->contratto->cliente->indirizzo}}</div>
        <div>{{$intervento->contratto->cliente->citta}}@if($intervento->contratto->cliente->provincia) , {{$intervento->contratto->cliente->provincia}} @endif</div>
        <div>{{$intervento->contratto->cliente->telefono}}</div>
        <div>{{$intervento->contratto->cliente->email}}</div>
    </div>
    <div id='infoConsulente'>
        <div id='titolo'>DATI CONSULENTE</div>
        <div class='bold'>{{$intervento->user->consulente->nominativo}}</div>
        <div>{{$intervento->user->email}}</div>
        <div>cell: {{$intervento->user->consulente->mobile}}</div>
    </div>
    <div id='infoContratto'>
        <div id='titolo'>CONTRATTO {{$intervento->contratto->id}}</div>
        <div>{{$intervento->contratto->progetto->nome}}</div>

    </div>
    <div id='infoRapportino'>
        <div id='titolo'>INTERVENTO</div>
        <div>Data: {{$intervento->data}}</div>
        <div>Attivit&agrave;: {{$intervento->attivita->descrizione}}</div>
        <div>Durata: {{$intervento->ore_lavorate +0}}</div>
    </div>
    <div id='testo'>
    <!--div id='attivitaPianificate'>
            <div id='titolo'>ATTIVIT&Agrave; PIANIFICATE</div>
            {{$intervento->attivita->attivitaPianificate}}
            </div-->
        <div id='attivitaSvolte'>
            <div id='titolo'>ATTIVIT&Agrave; SVOLTE</div>
            {{$intervento->attivita->attivitaSvolte}}
        </div>
        @if($intervento->attivita->problemiAperti <> "")
            <div id='attivitaProgrammate'>
                <div id='titolo'>ATTIVIT&Agrave; PROGRAMMATE</div>
                {{$intervento->attivita->problemiAperti}}
            </div>
        @endif
        <div id='attivitaInCaricoCliente'>
            <div id='titolo'>NOTE</div>
            {{$intervento->attivita->attivitaCaricoCliente}}
        </div>
    </div>
    <div id='firmaCliente'>
        <span>Referente cliente</span>
    </div>
    <div id='firmaConsulente'>
        <span>Consulente</span>
    </div>
</div>

</body>
</html>