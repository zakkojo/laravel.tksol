<?php
if (isset($contratto)) $cons = $contratto->capo_progetto;
elseif (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->consulente->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsuenti = $consulenti->each(function ($consulente)
{
    return $consulente['nomecognome'] = $consulente['nome'] . ' ' . $consulente['cognome'];
})->lists('nomecognome', 'id');

if (isset($contratto)) $cli = $contratto->cliente_id;
elseif (isset($_GET['cli'])) $cli = $_GET['cli'];
else $cli = 0;
if ($cli) $cliDisabled = 'disabled';
else $cliDisabled = 'enabled';
$listClienti = $clienti->lists('ragione_sociale', 'id');

if (isset($contratto)) $prog = $contratto->progetto_id;
elseif (isset($_GET['prog'])) $prog = $_GET['prog'];
else $prog = 0;
if ($prog) $progDisabled = 'disabled';
else $progDisabled = 'enabled';
$listProgetto = $progetti->each(function ($progetto)
{
    return $progetto['areanome'] = $progetto['area'] . ' / ' . $progetto['nome'];
})->lists('areanome', 'id');
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Consulente</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Consulente</label>
            {!! Form::select('capo_progetto',
                $listConsuenti,
                $cons,
                ['id'=>'capo_progetto','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                    aria-hidden="true">
                <option selected="selected">Senior</option>
                <option>Junior</option>
            </select>
        </div>


        <div class="form-group">
            <label>Cliente</label>
            {!! Form::select('cliente_id',
                $listClienti,
                $cli,
                [$cliDisabled => $cliDisabled,'id'=>'cliente_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
            @if($cli)<input type="hidden" name="cliente_id" value="{{$cli}}">@endif
        </div>
        <div class="form-group">
            <label>Progetto</label>
            {!! Form::select('progetto_id',
                $listProgetto,
                $prog,
                [$progDisabled => $progDisabled,'id'=>'progetto_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
            @if($prog)<input type="hidden" name="progetto_id" value="{{$prog}}">@endif
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                    aria-hidden="true">
                <option selected="selected">1. Avvio</option>
                <option>1.1. Installazione</option>
                <option>1.2. Configurazione</option>
                <option>...</option>
            </select>
        </div>
    </div>
</div>