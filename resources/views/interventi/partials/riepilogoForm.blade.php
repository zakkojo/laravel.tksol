<div class="box box-primary">
    <div class="box-header with-border">
        <h3 id="form_title" class="box-title">Riepilogo</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Consulente</label>
            <select id="consulente" name="consulente" style="width:100%" disabled
                    class="form-control select2 select2-hidden-accessible">
                <option value="{{$consulente->id}}">{{$consulente['nome'] . ' ' . $consulente['cognome'] . ' / ' . $consulente['tipo']}}</option>
            </select>
        </div>
        <input type="hidden" id="intervento_id" name="intervento_id">
        <div class="form-group">
            <label>Cliente</label>
            <select id="cliente" name="cliente" style="width:100%" disabled
                    class="form-control select2 select2-hidden-accessible">
                <option value="{{$cliente->id}}">{{$cliente['ragione_sociale']}}</option>
            </select>
        </div>
        <div class="form-group">
            <label>Contratto/Progetto</label>
            <select id="progetto" style="width:100%" class="form-control select2 select2-hidden-accessible"></select>
            <input type="hidden" id="contratto" name="contratto" value="">
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select id="attivita" name="attivita" style="width:100%" class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Listino</label>
            <select id="listinoContratto" name="listinoContratto" style="width:100%"
                    class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label>Data</label>
                <input type="text" id="data" name="data" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-4">
                <label>Ora Inizio</label>
                <input type="text" id="ora_start" name="ora_start" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-4">
                <label>Ora Fine</label>
                <input type="text" id="ora_end" name="ora_end" style="width:100%" readonly class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>Stato</label>
            <select id="stato" name="stato" style="width:100%" class="form-control">
                <option selected="selected">{{ $intervento->stato or ''}}</option>
                <option>Pianificato</option>
                <option>Da Confermare</option>
            </select>
        </div>
        <div class="form-group">
            <label>Fatturabile</label>
            <label>
                <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false"
                     style="position: relative;"><input type="checkbox" class="flat-red"
                                                        style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper"
                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                </div>
            </label>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            $('#consulente').trigger('change');
            $('#cliente').trigger('change');
            $('#data').val(moment('{{$intervento->data_start}}').format('L'));
            ora_start = moment('{{$intervento->data_start}}');
            ora_end = moment('{{$intervento->data_end}}');
            $('#ora_start').val(ora_start.format('HH:mm'));
            $('#ora_end').val(ora_end.format('HH:mm'));
        });

        $('#consulente').change(function () {
            globale_consulente = $('#consulente').val();
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
                                if (c == '1' || contratto.id == '{{$intervento->listinoInterventi->contratto->id}}') {
                                    $('#contratto').val(contratto.id);
                                    $('#progetto').select2('val', contratto.progetto.id);
                                }
                            });
                            if (c == 0) $('#progetto').select2('val', '');
                            globale_progetto = $('#progetto').val();
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
                                if (c == '1' || dettagli.id == '{{$intervento->attivita_id}}') {
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
                                if (c == '1' || dettagli.id == '{{$intervento->listino_id}}') {
                                    $('#listinoContratto').select2("val", dettagli.id);
                                }
                            });
                        });
            }
        });
    </script>@append