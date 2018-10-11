<?php

if (isset($_GET['cons'])) $cons = $_GET['cons'];
elseif (Auth::user()->id) $cons = Auth::user()->consulente->id;
else $cons = 0;
$listConsulenti = $consulenti->each(function ($consulente)
{
    $consulente['user_id'] = $consulente->user->id;

    return $consulente;
})->lists('nominativo', 'user_id');
$listConsulenti->prepend('', 0);
$consulente = $consulenti->find($cons);

if (isset($contratto)) $cli = $contratto->cliente_id;
elseif (isset($_GET['cli'])) $cli = $_GET['cli'];
else $cli = 0;
if ($cli) $cliDisabled = 'disabled';
else $cliDisabled = 'enabled';
$listClienti = $clienti->lists('ragione_sociale', 'id');
$listClienti->prepend('', 0);

if (isset($contratto)) $prog = $contratto->progetto_id;
elseif (isset($_GET['prog'])) $prog = $_GET['prog'];
else $prog = 0;
if ($prog) $progDisabled = 'disabled';
else $progDisabled = 'enabled';
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 id="form_title" class="box-title">Pianifica Nuovo Intervento</h3>
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
            $consulente->user_id,
            ['id'=>'consulente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}
        </div>
        <input type="hidden" id="intervento_id" name="intervento_id">
        <input type="hidden" id="stampaIntervento" name="stampaIntervento"
               value="{{ session()->get('stampaIntervento') ?: '0' }}">
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
            <label>Tipo Intervento</label>
            <select id="listinoContratto" style="width:100%" data-minlength="1"
                    class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Attività Pianificate</label>
            <div id="attivitaPianificate" name="attivitaPianificate" class="wysihtml5"
                 style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                 placeholder=""></div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label>Data</label>
                <input type="text" id="data" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-4">
                <label>Ora Inizio</label>
                <input type="text" id="ora_start" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-4">
                <label>Ora Fine</label>
                <input type="text" id="ora_end" style="width:100%" readonly class="form-control">
            </div>
        </div>
        <div class="box-footer">
            <div id="pulsanti_create" style="display:none">
                <div class="btn-group btn-group-justified">
                    <!--div type="Annulla" onclick="annullaCreateIntervento()" class="btn btn-default"><i
                                class="fa fa-remove"></i> Annulla
                    </div-->
                    <div id="btn-pianifica" type="Pianifica" onclick="createIntervento()" class="btn  btn-primary"><i
                                class="fa fa-calendar"></i> Pianifica
                    </div>
                </div>
            </div>
            <div id="pulsanti_update">
                <div class="btn-group btn-group-justified">
                    @if(1==0)
                        <div type="Elimina" onclick="deleteIntervento()" class="btn btn-danger"><i
                                    class="fa fa-trash"></i>
                            Elimina
                        </div>
                    @endif
                    <div type="Modifica" onclick="updateIntervento()" class="btnModifica btn  btn-primary"><i
                                class="fa fa-calendar"></i> Modifica
                    </div>
                    <div type="Dettagli" onclick="openIntervento()" class="btn-default btn"><i
                                class="fa fa-calendar"></i>
                        Dettagli
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            if ({{$cli}} == 0
            )
            $('#cliente').select2('val', '');
            $('.wysihtml5').wysihtml5({
                toolbar: {
                    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                    "emphasis": true, //Italics, bold, etc. Default true
                    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                    "html": false, //Button which allows you to edit the generated HTML. Default false
                    "link": false, //Button to insert a link. Default true
                    "image": false, //Button to insert an image. Default true,
                    "color": false, //Button to change color of font
                    "blockquote": false, //Blockquote
                    "size": 'sm' //default: none, other options are xs, sm, lg
                }
            });

            drawCalendar();
            colorconsulente();
            colorcliente();
            //$('#consulente').trigger('change');
            //$('#cliente').trigger('change');
            //$('#intervento_id').trigger('change');
            //Consulente->Tipo

        });


        //Cliente->Progetto
        $('#cliente').change(function () {
            $('#progetto').html('');
            $('#contratto').val('');
            if ($('#cliente').val()) {
                $('#progetto')
                    .append($("<option></option>")
                        .attr('value', 0)
                        .text(''));
                $.get('{{action('ConsulenteController@ajaxGetContratti')}}', {
                    cliente_id: $('#cliente').val(),
                    user_id: '{{Auth::User()->id}}'
                })
                    .done(function (data) {
                        var c = 0;
                        $.each(data, function (id, contratto) {
                            c++;
                            $('#progetto')
                                .append($("<option></option>")
                                    .attr('data-contratto', contratto.id)
                                    .attr('value', contratto.progetto.id)
                                    .text(contratto.progetto.area + ' / ' + contratto.progetto.nome)
                                )

                            if (c == '1' && globale_intervento.loading == 0) {
                                //$('#contratto').val(contratto.id);
                                //$('#progetto').select2('val', contratto.progetto.id);
                            }
                            else if (globale_intervento.loading == 1 && contratto.id == globale_intervento.contratto_id) {
                                $('#contratto').val(contratto.id);
                                $('#progetto').select2('val', contratto.progetto.id);
                            }
                        });
                        if (c == 0) $('#progetto').select2('val', '');
                        if ($('#intervento_id').val() == '') {

                        }
                    }).fail(function (jqXHR, textStatus, data) {
                        console.log("Request failed: " + data);
                    }
                )
            }
        });

        $('#progetto').change(function () {
            $('#attivita').html('');
            $('#attivita').select2('val', '');
            //Progetto->Attivita
            if ($('#progetto').val()) {
                $.get('{{ action('ProgettoController@ajaxGetAttivita') }}', {'progetto_id': $('#progetto').val()})
                    .done(function (data) {
                        //creo prima scelta empty
                        $('#attivita')
                            .append($("<option></option>")
                                .attr('value', '')
                                .text(''));
                        //aggiorno la form
                        var d = 0;
                        $.each(data, function (id, dettagli) {
                            d++;
                            lastoption = $('#attivita')
                                .append($("<option></option>")
                                    .attr('value', dettagli.id)
                                    .text(dettagli.descrizione));
                            if (d == '1' && globale_intervento.loading == 0) {
                                //$('#attivita').select2("val", dettagli.id);
                            }
                            else if (globale_intervento.loading == 1 && dettagli.id == globale_intervento.attivita_id) {
                                $('#attivita').select2("val", dettagli.id);
                            }
                            if (d == 0) $('#attivita').select2('val', '');
                        });

                        //Contratto->Listino
                        $('#listinoContratto').html('');
                        $('#listinoContratto').select2('val', '');
                        if (contratto_id = $($('#progetto').select2('data')[0].element).attr('data-contratto')) {
                            $.get('{{ action('ContrattoController@ajaxGetListinoInterventi') }}', {'contratto_id': contratto_id})
                                .done(function (data) {
                                    $('#listinoContratto')
                                        .append($("<option></option>")
                                            .attr('value', '')
                                            .text(''));
                                    var c = 0;
                                    $.each(data, function (id, dettagli) {
                                        c++;
                                        lastoption = $('#listinoContratto')
                                            .append($("<option></option>")
                                                .attr('value', dettagli.id)
                                                .text(dettagli.descrizione));
                                        if (c == '1' && globale_intervento.loading == 0) {
                                            //$('#listinoContratto').select2("val", dettagli.id);
                                        }
                                        else if (globale_intervento.loading == 1 && dettagli.id == globale_intervento.listino_id) {
                                            $('#listinoContratto').select2("val", dettagli.id);
                                            if (typeof globale_intervento.func === 'function') {
                                                globale_intervento.func(); //SALVO L'AGGIORNAMENTO
                                                globale_intervento = {'loading': 0};
                                            }
                                        }
                                        if (c == 0) $('#listinoContratto').select2('val', ''); // QUI NON HA SENSO
                                    });
                                });
                        }
                    });
            }
        });

        $('#intervento_id').change(function () {
            if ($('#stampaIntervento').val() == 0) {
                if ($('#intervento_id').val() == "") {
                    //sblocca cliente progetto
                    $('#cliente').prop('disabled', false);
                    $('#progetto').prop('disabled', false);

                    $('#pulsanti_update').hide();
                    $('#pulsanti_create').show();
                }
                else {
                    $('#cliente').prop('disabled', true);
                    $('#progetto').prop('disabled', true);

                    $('#pulsanti_update').show();
                    $('#pulsanti_create').hide();
                }
            }
            else {
                //$('#consulente').prop('disabled', true);
                $('#cliente').prop('disabled', true);
                $('#progetto').prop('disabled', true);
                $('#pulsanti_update').hide();
                $('#pulsanti_create').show();
            }
        });
    </script>@append