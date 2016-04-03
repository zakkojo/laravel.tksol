<?php

if (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->consulente->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsuenti = $consulenti->each(function ($consulente)
{
    return $consulente['nomecognome'] = $consulente['nome'] . ' ' . $consulente['cognome'];
})->lists('nomecognome', 'id');
$consulente = $consulenti->find($cons);

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
            {!! Form::select('consulente',
            $listConsuenti,
            $consulente->id,
            ['id'=>'consulente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}

        </div>
        <div class="form-group">
            <label>Tipo</label>
            <select id="consulente_tipo"></select>
        </div>
        <div class="form-group">
            <label>Cliente</label>
            {!! Form::select('cliente_id',
            $listClienti,
            $cli,
            [$cliDisabled => $cliDisabled,'id'=>'cliente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
        </div>
        <div class="form-group">
            <label>Contratto/Progetto</label>
            <select id="progetto"></select>
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select id="attivita"></select>
        </div>
    </div>
</div>
@section('page_scripts')
    @parent
    <script>
        $('document').ready(function () {
            //Consulente->Tipo
            $('#consulente').change(function () {
                $.get('{{action('ConsulenteController@ajaxGetConsulente')}}', {id: $('#consulente').val()})
                        .done(function (data) {
                            $('#consulente_tipo').val('data.tipo');
                        });
            });
            //Cliente->Progetto
            $('#cliente').change(function () {
                alert('cliente'+$('#cliente').val());
                if ($('#cliente').val()) {
                    $.get('{{action('ClienteController@ajaxGetProgetti')}}', {cliente_id: $('#cliente').val()})
                            .done(function (data) {
                                $('#progetto').html('');
                                $('#attivita').html('');
                                $.each(data, function (id, dettagli) {
                                    $('#progetto')
                                            .append($("<option></option>")
                                                    .attr('value', dettagli.id)
                                                    .text(dettagli.area + ' / ' + dettagli.nome));
                                });
                            });
                }
                $('#progetto').trigger("change");
            });
            //Progetto->Attivita
            $('#progetto').change(function () {
                alert($('#progetto').val());
                if ($('#progetto').val()) {
                    $.get('{{ action('ProgettoController@ajaxGetAttivita') }}', {'progetto_id': $('#progetto').val()})
                            .done(function (data) {
                                $('#attivita').html('');
                                $.each(data, function (id, dettagli) {
                                    $('#attivita')
                                            .append($("<option></option>")
                                                    .attr('value', id)
                                                    .text(dettagli.area + ' / ' + dettagli.nome));
                                });
                            });

                }
            });
            $('#consulente').trigger("change");
            $('#cliente').trigger("change");
            $('#progetto').trigger("change");

        });
    </script>
@endsection
