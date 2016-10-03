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
                <option value="{{$user->id}}">{{$user->consulente->nominativo . ' / ' . $user->consulente->tipo}}</option>
            </select>
            <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
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
            <select id="attivita" name="attivita" style="width:100%" @if($intervento->inviato) disabled @endif
                    class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group">
            <label>Listino</label>
            <select id="listinoContratto" name="listinoContratto" style="width:100%" @if($intervento->inviato) disabled @endif
                    class="form-control select2 select2-hidden-accessible"></select>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label>Data</label>
                <input type="text" id="data" name="data" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-3">
                <label>Inizio Intervento</label>
                <input type="text" id="ora_start_reale" onkeydown="return false;" name="ora_start_reale"
                       @if($intervento->inviato) readonly @endif
                       style="width:100%" class="form-control clockpicker">
                <input type="hidden" id="ora_start" name="ora_start" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-3">
                <label>Fine Intervento</label>
                <input type="text" id="ora_end_reale" onkeydown="return false;" name="ora_end_reale" style="width:100%"
                       @if($intervento->inviato) readonly @endif
                       class="form-control clockpicker">
                <input type="hidden" id="ora_end" name="ora_end" style="width:100%" readonly class="form-control">
            </div>
            <div class="col-md-3">
                <label class="ore_lavorate">Ore Lavorate</label>
                <span id="ore_mod" style="display:none" title="valore calcolato" class="label label-warning"><i
                            class="fa fa-warning"></i></span>
                <input type="text" id="ore_lavorate" name="ore_lavorate" style="width:100%"
                       @if($intervento->inviato) readonly @endif
                       value="{{ $intervento->ore_lavorate or ''}}"
                       class="form-control @if( $intervento->ore_lavorate >0 ) modificato @endif">
            </div>
        </div>
        <div class="form-group">
            <label>Sede</label>
            <select id="sede" name="sede" style="width:100%" @if($intervento->inviato) disabled @endif class="form-control">
                <option selected="selected">{{ $intervento->sede or ''}}</option>
                <option>Sede Cliente</option>
                <option>Back Office</option>
            </select>
        </div>
        <div class="form-group">
            <label>
                <?php $fatturabile_check = ($intervento->fatturabile == '1') ? 'checked' : '';
                $fatturabile_disabled[] = ($intervento->inviato == '1') ? 'disabled' : '' ?>
                {!!  Form::checkbox('fatturabile', 'fatturabile', $fatturabile_check, $fatturabile_disabled) !!}
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
            ora_start_reale = moment('{{$intervento->data_start_reale}}');
            ora_end_reale = moment('{{$intervento->data_end_reale}}');
            $('#ora_start').val(ora_start.format('HH:mm'));
            $('#ora_end').val(ora_end.format('HH:mm'));

            if ('{{$intervento->data_start_reale}}' == '0000-00-00 00:00:00')  $('#ora_start_reale').val(ora_start.format('HH:mm'));
            else $('#ora_start_reale').val(moment('{{$intervento->data_start_reale}}').format('HH:mm'));

            if ('{{$intervento->data_start_reale}}' == '0000-00-00 00:00:00')  $('#ora_end_reale').val(ora_end.format('HH:mm'));
            else $('#ora_end_reale').val(moment('{{$intervento->data_end_reale}}').format('HH:mm'));

            $('.clockpicker').clockpicker({
                placement: 'top',
                align: 'left',
                donetext: 'OK',
                afterDone: function () {
                    aggiornaOreLavorate();
                }
            });

            $('#ora_start_reale').on('change', aggiornaOreLavorate());
            $('#ora_end_reale').on('change', aggiornaOreLavorate());

        });

        function aggiornaOreLavorate() {
            if (!$('#ore_lavorate').hasClass('modificato')) {
                $('#ore_mod').show();
                var orastart = moment('2000-01-01 ' + $('#ora_start_reale').val(), 'YYYY-MM-DD HH:mm');
                var oraend = moment('2000-01-01 ' + $('#ora_end_reale').val(), 'YYYY-MM-DD HH:mm');

                var decimale = oraend.diff(orastart, 'hours', true) % 1;
                var dec = 0;
                if (decimale < 0.33) dec = 0;
                else if (decimale < 0.67) dec = 0.5;
                else dec = 1;
                $('#ore_lavorate').val(Math.floor(oraend.diff(orastart, 'hours', true)) + dec);
            }
            else $('#ore_mod').hide();
        }

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
                $.get('{{ action('ContrattoController@ajaxGetListinoInterventi') }}', {'contratto_id': '{{ $intervento->listinoInterventi->contratto->id }}'})
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