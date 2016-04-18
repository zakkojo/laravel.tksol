<?php

if (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->consulente->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsulenti = $consulenti->each(function ($consulente)
{
    return $consulente['consulente'] = $consulente['nome'] . ' ' . $consulente['cognome'].' / '.$consulente['tipo'];
})->lists('consulente', 'id');
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
        <h3 id="form_title" class="box-title">Consulente</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Consulente</label>
            {!! Form::select('consulente',
            $listConsulenti,
            $consulente->id,
            ['id'=>'consulente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}

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
            <select id="progetto" style="width:100%" class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select id="attivita" style="width:100%" class="form-control select2 select2-hidden-accessible"></select>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            //Consulente->Tipo
            $('#consulente').change(function () {
                $.get('{{action('ConsulenteController@ajaxGetConsulente')}}', {id: $('#consulente').val()})
                        .done(function (data) {
                            $('#consulente_tipo')
                                    .append($("<option></option>")
                                            .attr('value', data.tipo)
                                            .text(data.tipo));
                        });
            });
            //Cliente->Progetto
            $('#cliente').change(function () {
                $('#progetto').html('');
                $('#attivita').html('');
                if ($('#cliente').val()) {
                    $.get('{{action('ClienteController@ajaxGetProgetti')}}', {cliente_id: $('#cliente').val()})
                            .done(function (data) {
                                var c = 0;
                                $.each(data, function (id, dettagli) {
                                    c++;
                                    $('#progetto')
                                            .append($("<option></option>")
                                                    .attr('value', dettagli.id)
                                                    .text(dettagli.area + ' / ' + dettagli.nome));
                                    if (c == '1') {
                                        $('#progetto').select2('val', dettagli.id);
                                    }
                                });
                                $('#progetto').trigger("change");
                                drawCalendar();
                            });
                }
            });
            //Progetto->Attivita
            $('#progetto').change(function () {
                $('#attivita').html('');
                if ($('#progetto').val()) {
                    $.get('{{ action('ProgettoController@ajaxGetAttivita') }}', {'progetto_id': $('#progetto').val()})
                            .done(function (data) {
                                var c = 0;
                                $('#attivita').html('');
                                $.each(data, function (id, dettagli) {
                                    c++;
                                    lastoption = $('#attivita')
                                            .append($("<option></option>")
                                                    .attr('value', dettagli.id)
                                                    .text(dettagli.descrizione));
                                    if (c == '1') {
                                        $('#attivita').select2("val", dettagli.id);
                                    }
                                });
                            });

                }
            });
            $('#consulente').trigger("change");
            $('#cliente').trigger("change");

        });
    </script>
@append
