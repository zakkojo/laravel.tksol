<?php
$listConsulenti = $consulenti->each(function ($consulente)
{
    $consulente['user_id'] = $consulente->user->id;

    return $consulente;
})->pluck('nominativo', 'user_id');
$listConsulenti->prepend('', 0);

$listClienti = $clienti->pluck('ragione_sociale', 'id');
$listClienti->prepend('', 0);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
<div class="box box-primary">
    <div id="searcheader" class="boxsearch box-header with-border">
        <h3 id="search_title" class="box-title">Filtro Calendari</h3>
        <div class="box-tools pull-right btn-filtri">
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

            <ul class="customsearch consulente"></ul>
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
    <div class="box-footer"></div>
</div>

@section('page_scripts')
    <script>
        var searchParams = new URLSearchParams(window.location.search.substring(1));
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

        $('.btn-filtri').on('click', '.btn-box-tool', function () {
            if ($(this).has('.boxsearch.fa.fa-plus').length > 0) {
                $('.customsearch.consulente').appendTo('#formconsulente');
                $('.customsearch.cliente').appendTo('#formcliente');
            }
            else {
                $('.customsearch.consulente').appendTo('#searcheader');
                $('.customsearch.cliente').appendTo('#searcheader');
            }
        });

        function addFiltroCliente(id) {
            $k = 'filtri_calendar.clienti.' + id;
            $v = null;
            $.get('/ajax/helper/setSession', {key: $k, val: $v});
            var descrizione = $('#search_cliente option[value="' + id + '"]').text();
            if ($('li[data-cliente_id="' + (parseInt(id)) + '"]').length == 0 && id != 0) {
                $('.customsearch.cliente').append('<li data-cliente_id="' + (parseInt(id)) + '" title="' + descrizione + '" ><span>×</span>' + descrizione + '</li>');
                colorcliente();
            }
        }
        function addFiltroConsulente(id) {
            $k = 'filtri_calendar.consulenti.' + id;
            $v = null;
            $.get('/ajax/helper/setSession', {key: $k, val: $v});
            var descrizione = $('#search_consulente option[value="' + id + '"]').text();
            if ($("li[data-consulente_id='" + (parseInt(id)) + "']").length == 0 && id != 0) {
                $('.customsearch.consulente').append('<li data-consulente_id="' + (parseInt(id)) + '" title="' + descrizione + '" ><span>×</span>' + descrizione + '</li>');
                colorconsulente();
            }
        }


        $('document').ready(function () {
            $('.customsearch.consulente').on('click', 'span', function () {
                $k = 'filtri_calendar.consulenti.' + $($(this).closest('li')[0]).data().consulente_id;
                $v = null;
                $.get('/ajax/helper/pullSession', {key: $k, val: $v});
                $('#calendar').fullCalendar('removeEventSource', "consulente_" + $(this).closest('li').attr('data-consulente_id'));
                $('#calendar').fullCalendar('removeEventSource', "consulente_inviato_" + $(this).closest('li').attr('data-consulente_id'));
                $(this).closest('li').remove();
                colorconsulente();
            });
            $('.customsearch.cliente').on('click', 'span', function () {
                $k = 'filtri_calendar.clienti.' + $($(this).closest('li')[0]).data().cliente_id;
                $v = null;
                $.get('/ajax/helper/pullSession', {key: $k, val: $v});
                $('#calendar').fullCalendar('removeEventSource', "cliente_inviato_" + $(this).closest('li').attr('data-cliente_id'));
                $('#calendar').fullCalendar('removeEventSource', "cliente_" + $(this).closest('li').attr('data-cliente_id'));
                $(this).closest('li').remove();
                colorcliente();
            });
            $('#search_consulente').on("select2:select", function (e) {
                addFiltroConsulente(e.params.data.id);
                $('#search_consulente').select2("val", "");
            });
            $('#search_cliente').on("select2:select", function (e) {
                addFiltroCliente(e.params.data.id);
                $('#search_cliente').select2("val", "");
            });

            var filtri_calendar =  {!! json_encode(session()->get('filtri_calendar')) !!} ;

            if (searchParams.has('consulente') || searchParams.has('cliente')) {
                searchParams.getAll('consulente').forEach(function (id) {
                    addFiltroConsulente(id)
                });
                searchParams.getAll('cliente').forEach(function (id) {
                    addFiltroCliente(id)
                });
            }
            else {
                if (filtri_calendar) {
                    if (typeof filtri_calendar.clienti !== "undefined") {
                        $.each(filtri_calendar.clienti, function (id, val) {
                            addFiltroCliente(id);
                        });
                    }
                    if (typeof filtri_calendar.consulenti !== "undefined") {
                        $.each(filtri_calendar.consulenti, function (id, val) {
                            addFiltroConsulente(id)
                        });
                    }
                }
            }


            //{"filtro_calendar":{"clienti":[1,2,3,4], "consulenti":[1,2,3,4]}}
            var filtri_calendar =  {!! json_encode(session()->get('filtri_calendar')) !!};

            if (filtri_calendar) {
                if (typeof filtri_calendar.clienti !== "undefined") {
                    $.each(filtri_calendar.clienti, function (id, val) {
                        addFiltroCliente(id);
                    });
                }
                if (typeof filtri_calendar.consulenti !== "undefined") {
                    if (filtri_calendar.consulenti.length == 0 && filtri_calendar.clienti.length == 0){
                        addFiltroConsulente({!! Auth::user()->id !!});
                    }
                    else {
                        $.each(filtri_calendar.consulenti, function (id, val) {
                            addFiltroConsulente(id)
                        });
                    }
                }
            }
            else {
                addFiltroConsulente({!! Auth::user()->id !!});
            }
        });
    </script>
@append