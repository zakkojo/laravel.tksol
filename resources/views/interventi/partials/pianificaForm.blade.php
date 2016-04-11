<?php
if (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->consulente->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsuenti = $consulenti->each(function ($consulente) {
    return $consulente['nomecognome'] = $consulente['nome'] . ' ' . $consulente['cognome'];
})->lists('nomecognome', 'id');
$consulente = Consulente::find($cons);

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
$listProgetto = $progetti->each(function ($progetto) {
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
            {!! Form::select('consulente',
                $listConsuenti,
                $consulente->id,
                ['id'=>'consulente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
        </div>
        <div class="form-group">
            <label>Tipo</label>
            {!! Form::select('consulente_tipo',
                ['PARTNER'=>'Partner','SENIOR'=>'Senior','JUNIOR'=>'junior'],
                $consulente->tipo,
                ['id'=>'consulente_tipo','style'=>'width:100%', 'class'=>'form-control'])
            !!}
        </div>
        <div class="form-group">
            <label>Cliente</label>
            {!! Form::select('cliente_id',
                $listClienti,
                $cli,
                [$cliDisabled => $cliDisabled,'id'=>'cliente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
            @if($cli)<input type="hidden" name="cliente_id" value="{{$cli}}">@endif
        </div>
        <div class="form-group">
            <label>Contratto/Progetto</label>
            {!! Form::select('progetto_id',
                $listProgetto,
                $prog,
                [$progDisabled => $progDisabled,'id'=>'progetto','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
            @if($prog)<input type="hidden" name="progetto_id" value="{{$prog}}">@endif
        </div>
        <div class="form-group">
            <label>Attività</label>
            {!! Form::select('attivita',
                $listattivita,
                $att,
                ['id'=>'attivita','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
        </div>
    </div>
</div>
@section('page_scripts')
    @parent
    <script>
        $.document.ready(function () {
            //Consulente->Tipo
            $('#consulente').change(function () {
                $.get('{{action('ConsulenteController@ajaxGetConsulente')}}}', {id: $('#consulente').val()})
                        .done(function (data) {
                            $('#consulente_tipo').val('data.tipo');
                        });
            });
            //Cliente->Progetto
            $('#cliente').change(function () {
                $.get('{{action('ClienteController@ajaxGetProgetti')}}}', {id: $('#cliente').val()})
                        .done(function (data) {
                            $('#progetto').html('');
                            $('#attivita').html('');
                            $.each(data, function (id, dettagli) {
                                $('#progetto')
                                        .append($("<option></option>")
                                                .attr('value', id)
                                                .text(dettagli.area + ' / ' + dettagli.nome));
                            });
                        });
            });
            //Progetto->Attivita
            $('#progetto').change(function () {
                $.get('{{action('ProgettoController@ajaxGetAttivita')}}}', {id: $('#progetto').val()})
                        .done(function (data) {
                            $('#attivita').html('');
                            $.each(data, function (id, dettagli) {
                                $('#attivita')
                                        .append($("<option></option>")
                                                .attr('value', id)
                                                .text(dettagli.area + ' / ' + dettagli.nome));
                            });
                        });
            });

        });
    </script>
@endsection