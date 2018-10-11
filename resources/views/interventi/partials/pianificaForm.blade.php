<?php

if (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->consulente->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsulenti = $consulenti->each(function ($consulente)
{
    return $consulente['consulente'] = $consulente['nome'] . ' ' . $consulente['cognome'] . ' / ' . $consulente['tipo'];
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
        <input type="hidden" id="intervento_id" name="intervento_id">
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
            <input type="hidden" id="contratto" name="contratto" value="">
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select id="attivita" style="width:100%" class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Listino</label>
            <select id="listinoContratto" style="width:100%"
                    class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Data</label>
            <input type="text" id="data" style="width:100%" readonly class="form-control">
        </div>
        <div class="form-group">
            <label>Ora Inizio</label>
            <input type="text" id="ora_start" style="width:100%" readonly class="form-control">
        </div>
        <div class="form-group">
            <label>Ora Fine</label>
            <input type="text" id="ora_end" style="width:100%" readonly class="form-control">
        </div>
    </div>
    <div class="box-footer">
        <div id="pulsanti_create" style="display:none">
            <div class="btn-group btn-group-justified">
                <div type="Annulla"
                     onclick="annullaCreateIntervento()"
                     class="btn btn-default"><i class="fa fa-remove"></i> Annulla
                </div>
                <div type="Pianifica"
                     onclick="updateIntervento()"
                     class="btn  btn-primary"><i class="fa fa-calendar"></i> Pianifica
                </div>
            </div>
        </div>
        <div id="pulsanti_update">
            <div class="btn-group btn-group-justified">
                <div type="Elimina"
                        onclick="deleteIntervento()"
                        class="btn btn-danger"><i class="fa fa-trash"></i> Elimina
                </div>
                <div type="Modifica"
                     onclick="updateIntervento()"
                     class="btn  btn-primary"><i class="fa fa-calendar"></i> Modifica
                </div>
            </div>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            drawCalendar();
            $('#consulente').trigger('change');
            $('#cliente').trigger('change');
            //Consulente->Tipo
        });
        $('#consulente').change(function () {
            globale_consulente = $('#consulente').val();
            $.get('{{action('ConsulenteController@ajaxGetConsulente')}}', {id: $('#consulente').val()})
                    .done(function (data) {
                        $('#consulente_tipo')
                                .append($("<option></option>")
                                        .attr('value', data.tipo)
                                        .text(data.tipo));
                        updateConsulenteSource();
                    });
        });
        //Cliente->Progetto
        $('#cliente').change(function () {
            $('#progetto').html('');
            $('#contratto').val('');
            if ($('#cliente').val()) {
                $.get('{{action('ClienteController@ajaxGetContratti')}}', {cliente_id: $('#cliente').val()})
                        .done(function (data) {

                            var c = 0;
                            $.each(data.contratti, function (id, contratto) {
                                c++;
                                $('#progetto')
                                        .append($("<option></option>")
                                                .attr('value', contratto.progetto.id)
                                                .text(contratto.progetto.area + ' / ' + contratto.progetto.nome));
                                if (c == '1') {
                                    $('#contratto').val(contratto.id);
                                    $('#progetto').select2('val', contratto.progetto.id);
                                }
                            });
                            if (c == 0) $('#progetto').select2('val', '');
                            globale_progetto = $('#progetto').val();
                            updateProgettoSource();
                        });
            }
        });

        $('#progetto').change(function () {
            $('#attivita').html('');
            $('#attivita').select2('val', '');
            globale_progetto = $('#progetto').val();
            //Progetto->Attivita
            if ($('#progetto').val()) {
                $.get('{{ action('ProgettoController@ajaxGetAttivita') }}', {'progetto_id': $('#progetto').val()})
                        .done(function (data) {
                            var c = 0;
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
            //Contratto->Listino
            $('#listinoContratto').html('');
            $('#listinoContratto').select2('val', '');
            if ($('#contratto').val()) {
                $.get('{{ action('ContrattoController@ajaxGetListinoInterventi') }}', {'contratto_id': $('#contratto').val()})
                        .done(function (data) {
                            var c = 0;
                            $.each(data, function (id, dettagli) {
                                c++;
                                lastoption = $('#listinoContratto')
                                        .append($("<option></option>")
                                                .attr('value', dettagli.id)
                                                .text(dettagli.descrizione));
                                if (c == '1') {
                                    $('#listinoContratto').select2("val", dettagli.id);
                                }
                            });
                        });
            }
        });

        $('#intervento_id').change(function () {
            if ($('#intervento_id').val() == ""){
                $('#pulsanti_update').hide();
                $('#pulsanti_create').show();
            }
            else {
                $('#pulsanti_update').show();
                $('#pulsanti_create').hide();
            }
        });



    </script>@append
