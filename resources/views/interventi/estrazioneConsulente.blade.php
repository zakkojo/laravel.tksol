<?php
$listConsulenti = $consulenti->each(function ($consulente)
{
    $consulente['user_id'] = $consulente->user->id;

    return $consulente;
})->lists('nominativo', 'user_id');
$listConsulenti->prepend('', 0);

$listClienti = $clienti->lists('ragione_sociale', 'id');
$listClienti->prepend('', 0);
?>@extends('layouts.app')


@section('htmlheader_title')
    Estrazione Interventi
@endsection
@section('contentheader_title')
    Estrazione Interventi
@endsection
@section('contentheader_breadcrumb')
@endsection
@section('main-content')
    <div class="col-md-4">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 id="form_title" class="box-title">Filtri</h3>
            </div>
            {{ Form::open(['url' => 'interventi/estrazioneXlsx', 'method' => 'GET' ]) }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Da:</label>
                            <div><input name="di" size='10' type='text' id='di' class="datepicker"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>A:</label>
                            <div><input name="df" size='10' type='text' id='df' class="datepicker"></div>
                        </div>
                    </div>
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
            <div class="box-footer">
                <button id="resetBtn" type="reset" onClick="resetForm()" class="btn  btn-primary"><i
                            class="fa fa-download"></i>&nbsp; Reset
                    <button id="inviaBtn" type="submit" class="btn  btn-primary"><i class="fa fa-download"></i>&nbsp;
                        Estrai
                    </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
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
        function resetForm() {
            $.get('/ajax/helper/pullSession', {key: 'filtri_estrazioneConsulente', val: null}, function () {
                location.reload();
            });
        }
        function colorconsulente() {
            $(".customsearch.consulente > li").each(function (x) {
                this.style.backgroundColor = bgconsulente[x % bgconsulente.length];
            });
        }
        function colorcliente() {
            $(".customsearch.cliente > li").each(function (x) {
                this.style.backgroundColor = bgcliente[x % bgcliente.length];
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
            var descrizione = $('#search_cliente option[value="' + id + '"]').text();
            if ($('li[data-cliente_id="' + (parseInt(id)) + '"]').length == 0 && id != 0) {
                $('.customsearch.cliente').append('<li data-cliente_id="' + (parseInt(id)) + '" title="' + descrizione + '" ><span>×</span>' + descrizione + '</li>');
                colorcliente();
            }
        }
        function addFiltroConsulente(id) {
            var descrizione = $('#search_consulente option[value="' + id + '"]').text();
            if ($("li[data-consulente_id='" + (parseInt(id)) + "']").length == 0 && id != 0) {
                $('.customsearch.consulente').append('<li data-consulente_id="' + (parseInt(id)) + '" title="' + descrizione + '" ><span>×</span>' + descrizione + '</li>');
                colorconsulente();
            }
        }


        $('document').ready(function () {
            if ($('#di').val() == "") {
                $('#di').val(moment().startOf('month').format('L'));
                $('#df').val(moment().endOf('month').format('L'));
            }
            $('.customsearch.consulente').on('click', 'span', function () {
                $k = 'filtri_estrazioneConsulente.consulenti.' + $($(this).closest('li')[0]).data().consulente_id;
                $v = null;
                $.get('/ajax/helper/pullSession', {key: $k, val: $v});
                $(this).closest('li').remove();
                colorconsulente();
            });
            $('.customsearch.cliente').on('click', 'span', function () {
                $k = 'filtri_estrazioneConsulente.clienti.' + $($(this).closest('li')[0]).data().cliente_id;
                $v = null;
                $.get('/ajax/helper/pullSession', {key: $k, val: $v});
                $(this).closest('li').remove();
                colorcliente();
            });
            $('#search_consulente').on("select2:select", function (e) {
                addFiltroConsulente(e.params.data.id);
                $k = 'filtri_estrazioneConsulente.consulenti.' + e.params.data.id;
                $v = null;
                $.get('/ajax/helper/setSession', {key: $k, val: $v});
                $('#search_consulente').select2("val", "");
            });
            $('#search_cliente').on("select2:select", function (e) {
                addFiltroCliente(e.params.data.id);
                $k = 'filtri_estrazioneConsulente.clienti.' + e.params.data.id;
                $v = null;
                $.get('/ajax/helper/setSession', {key: $k, val: $v});
                $('#search_cliente').select2("val", "");
            });

            var filtri_estrazioneConsulente =  {!! json_encode(session()->get('filtri_estrazioneConsulente')) !!} ;

            if (searchParams.has('consulente') || searchParams.has('cliente')) {
                searchParams.getAll('consulente').forEach(function (id) {
                    addFiltroConsulente(id)
                });
                searchParams.getAll('cliente').forEach(function (id) {
                    addFiltroCliente(id)
                });
            }
            else {
                if (filtri_estrazioneConsulente) {
                    if (typeof filtri_estrazioneConsulente.clienti !== "undefined") {
                        $.each(filtri_estrazioneConsulente.clienti, function (id, val) {
                            addFiltroCliente(id);
                        });
                    }
                    if (typeof filtri_estrazioneConsulente.consulenti !== "undefined") {
                        $.each(filtri_estrazioneConsulente.consulenti, function (id, val) {
                            addFiltroConsulente(id)
                        });
                    }
                }
            }
        });
    </script>
@endsection

