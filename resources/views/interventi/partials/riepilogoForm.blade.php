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
            <input type="hidden" id="consulente_id" name="consulente_id" value="{{$consulente->id}}">
        </div>
        <input type="hidden" id="intervento_id" name="intervento_id" value="{{$intervento->id}}">
        <div class="form-group">
            <label>Cliente</label>
            <select id="cliente" name="cliente" style="width:100%" disabled
                    class="form-control select2 select2-hidden-accessible">
                <option value="{{$cliente->id}}">{{$cliente['ragione_sociale']}}</option>
            </select>
            <input type="hidden" id="cliente_id" name="cliente_id" value="{{$cliente->id}}">
        </div>
        <div class="form-group">
            <label>Contratto/Progetto</label>
            <select id="progetto" style="width:100%" disabled class="form-control select2 select2-hidden-accessible">
                <option value="{{$contratto->progetto->id}}">{{$contratto->progetto->area.' / '.$contratto->progetto->nome}}</option>
            </select>
            <input type="hidden" id="progetto_id" name="progetto_id" value="{{$contratto->progetto->id}}">
        </div>
        <div class="form-group">
            <label>Attività</label>
            <select id="attivita" name="attivita" style="width:100%"
                    class="form-control select2 select2-hidden-accessible"></select>
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
                <input type="text" id="ora_start_reale" onkeydown="return false;" name="ora_start_reale"
                       style="width:100%" class="form-control clockpicker">
                <input type="hidden" id="ora_start" name="ora_start" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-4">
                <label>Ora Fine</label>
                <input type="text" id="ora_end_reale" onkeydown="return false;" name="ora_end_reale" style="width:100%"
                       class="form-control clockpicker">
                <input type="hidden" id="ora_end" name="ora_end" style="width:100%" readonly class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>Sede</label>
            <select id="sede" name="sede" style="width:100%" class="form-control">
                <option selected="selected">{{ $intervento->sede or ''}}</option>
                <option>Sede Cliente</option>
                <option>Back Office</option>
            </select>
        </div>
        <div class="form-group">
            <?php $fatturabile = ($intervento->fatturabile == '1') ? 'checked' : '' ?>
            <label>
                <div class="icheckbox_flat-green" style="position: relative; margin-right:10px;"><input
                            {{ $fatturabile }} name="fatturabile" type="checkbox" class="flat-red"
                            style="position: absolute; opacity: 0;">
                </div>
            </label>
            <label>Fatturabile</label>
        </div>
    </div>
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            $('#progetto').trigger('change');
            $('#data').val(moment('{{$intervento->data_start}}').format('L'));
            ora_start = moment('{{$intervento->data_start}}');
            ora_end = moment('{{$intervento->data_end}}');
            $('#ora_start').val(ora_start.format('HH:mm'));
            $('#ora_end').val(ora_end.format('HH:mm'));

            if ('{{$intervento->data_start_reale}}' == '0000-00-00 00:00:00')  $('#ora_start_reale').val(ora_start.format('HH:mm'));
            else $('#ora_start_reale').val(moment('{{$intervento->data_start_reale}}').format('HH:mm'));

            if ('{{$intervento->data_start_reale}}' == '0000-00-00 00:00:00')  $('#ora_end_reale').val(ora_end.format('HH:mm'));
            else $('#ora_end_reale').val(moment('{{$intervento->data_end_reale}}').format('HH:mm'));

            $('.clockpicker').clockpicker({
                placement: 'top',
                align: 'left',
                donetext: 'OK'
            });

        });


        $('#progetto').change(function () {
            $('#attivita').html('');
            $('#attivita').select2('val', '');
            $('#listinoContratto').html('');
            $('#listinoContratto').select2('val', '');
            //Progetto->Attivita
            if ($('#progetto').val()) {
                $.get('{{ action('ProgettoController@ajaxGetAttivita') }}', {'progetto_id': $('#progetto_id').val()})
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
                //Contratto->Listino
                $.get('{{ action('ContrattoController@ajaxGetListinoInterventi') }}', {'contratto_id': '{{ $intervento->listinoInterventi->contratto->id }}' })
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