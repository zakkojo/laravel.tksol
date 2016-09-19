<?php
if (isset($_GET['user'])) $user = $_GET['user'];
elseif (Auth::user()->id) $user = Auth::user()->id;
else $user = null;
$listConsulenti = $consulenti->each(function ($consulente)
{
    $consulente['user_id'] = $consulente->user->id;
    return $consulente;
})->lists('nominativo', 'user_id');
$listConsulenti->prepend('', 0);
$search_cons[] = $consulenti->find(Auth::user()->consulente->id);

$listClienti = $clienti->lists('ragione_sociale', 'id');
$listClienti->prepend('', 0);
?>
<div class="box box-primary">
    <div id="searcheader" class="boxsearch box-header with-border">
        <h3 id="form_title" class="box-title">Pianifica Nuovo Intervento</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="boxsearch fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div id="formconsulente" class="form-group">
            <label>Consulente</label>
            {!! Form::select('user_id',
            $listConsulenti,
            '',
            ['id'=>'search_consulente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}

            <ul class="customsearch consulente">
                @if($user)
                    @foreach($search_cons as $search_con)
                        <li data-consulente_id="{{$search_con->id}}" title="{{$search_con->nominativo}}">
                            <span>×</span>{{$search_con->nominativo}}</li>
                    @endforeach
                @endif
            </ul>
        </div>

        <input type="hidden" id="intervento_id" name="intervento_id">
        <input type="hidden" id="stampaIntervento" name="stampaIntervento"
               value="{{ session()->get('stampaIntervento') ?: '0' }}">
        <div id="formcliente" class="form-group">
            <label>Cliente</label>
            {!! Form::select('cliente_id',
            $listClienti,
            NULL,
            ['id'=>'search_cliente','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
            !!}

            <ul class="customsearch cliente"></ul>
        </div>

    </div>
    <div class="box-footer">
        <div class="btn-group btn-group-justified">
            <div type="Filtra" onclick="updateIntervento()" class="btnFiltra btn btn-primary"><i
                        class="fa fa-calendar"></i>
                Filtra
            </div>
        </div>
    </div>
</div>

@section('page_scripts')
    <script>
        var bgconsulente = [
            "#005BF1", //blu
            "#5AC594", //verde
            "#9895C6", //porpora
            "#00C0EF", //azzurro
            "#007941", //verdone
            "#39CCCC",  //acqua
        ];
        var bgcliente = [
            "#DD4B39", //rosso
            "#EA4E87", //fucksia
            "#FC8F2F", //arancio
            "#AE283C", //bordo
            "#B5BBC8", //grigio
            "#828893", //grigione
        ];

        function colorconsulente() {
            $(".customsearch.consulente > li").each(function (x) {
                this.style.backgroundColor = bgconsulente[x % bgconsulente.length];
                //$('#calendar').fullCalendar('getEventSourceById ', $(this).attr('data-consulente_id')).backgroundColor = bgconsulente[x % bgconsulente.length];
                //$('#calendar').fullCalendar('refetchEventSources', $(this).attr('data-consulente_id'));
                updateConsulenteSource($(this).attr('data-consulente_id'), bgconsulente[x % bgconsulente.length]);
            });
        }
        function colorcliente() {
            $(".customsearch.cliente > li").each(function (x) {
                this.style.backgroundColor = bgcliente[x % bgcliente.length];
                updateClienteSource($(this).attr('data-cliente_id'), bgcliente[x % bgcliente.length]);
            });
        }

        $('.btn-box-tool').on('click', '.boxsearch.fa.fa-minus', function () {
            $('.customsearch.consulente').appendTo('#searcheader');
            $('.customsearch.cliente').appendTo('#searcheader');
        });
        $('.btn-box-tool').on('click', '.boxsearch.fa.fa-plus', function () {
            $('.customsearch.consulente').appendTo('#formconsulente');
            $('.customsearch.cliente').appendTo('#formcliente');
        });


        $('document').ready(function () {
            $('.customsearch.consulente').on('click', 'span', function () {
                $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=' + $(this).closest('li').attr('data-consulente_id'));
                $(this).closest('li').remove();
                colorconsulente();
            });
            $('.customsearch.cliente').on('click', 'span', function () {
                $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=' + $(this).closest('li').attr('data-cliente_id'));
                $(this).closest('li').remove();
                colorcliente();
            });
            $('#search_consulente').on("select2:select", function (e) {
                if ($("li[data-consulente_id='" + (parseInt(e.params.data.id)) + "']").length == 0 && e.params.data.id != 0) {
                    $('.customsearch.consulente').append('<li data-consulente_id="' + (parseInt(e.params.data.id)) + '" title="' + e.params.data.text + '" ><span>×</span>' + e.params.data.text + '</li>');
                    colorconsulente();
                    //var bgcolor = $('li[data-consulente_id="' + (1000 + parseInt(e.params.data.id)) + '"]').css('backgroundColor');
                    //updateConsulenteSource((1000 + parseInt(e.params.data.id)), bgcolor);
                }
            });
            $('#search_cliente').on("select2:select", function (e) {
                if ($('li[data-cliente_id="' + (parseInt(e.params.data.id)) + '"]').length == 0 && e.params.data.id != 0) {
                    $('.customsearch.cliente').append('<li data-cliente_id="' + (parseInt(e.params.data.id)) + '" title="' + e.params.data.text + '" ><span>×</span>' + e.params.data.text + '</li>');
                    colorcliente();
                    //refresh_calendar();
                }
            });
        });
    </script>@append