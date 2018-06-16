@extends('layouts.app')


@section('htmlheader_title')
    DASHBOARD {{$consulente->nominativo}}
@endsection
@section('contentheader_title')
    @if($consulente->id)
        {{$consulente->nominativo}}
    @else
        Nuovo Utente
    @endif
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <div id="infoApprovazione" class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-line-chart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Interventi da approvare</span>
                    <span class="info-box-number">--</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-md-3">
            <div id="infoFatturazione" class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-green"><i class="fa fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <a href="{{action('InterventoController@registraFattura')}}">Registra Fatture</a>
                        <!--a href="{{action('InterventoController@export_xlsx')}}">Scarica report per Fatturazione</a-->
                    </span>
                    <span class="info-box-number"></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('consulenti.partials.prossimiInterventi')
        </div>
        <div class="col-md-6">
            @include('consulenti.partials.contrattiSenzaInterventi')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('consulenti.partials.interventiDaApprovare')
        </div>
    </div>
@endsection
@section('page_scripts')
    @parent
    <script>
        function updateInterventiDaApprovare() {
            $('#infoApprovazione').addClass('loading');
            $.get('{{action('ConsulenteController@ajaxGetInterventiDaApprovare')}}')
                .done(function (data) {
                    $('#infoApprovazione').find('.info-box-number').text(data);
                    console.log("OK: " + data);
                    return data;
                })
                .fail(function (jqXHR, textStatus, data) {
                    $('#infoApprovazione').find('.info-box-number').text('--');
                    console.log("Request failed: " + data);
                    return false;
                })
                .always(function (jqXHR, textStatus, data) {
                    $('#infoApprovazione').toggleClass('loading');
                });
        }
        $(document).ready(function () {
            updateInterventiDaApprovare();
            $('#infoApprovazione').on('click','.info-box-icon', function () {
                updateInterventiDaApprovare();
            });
            $('#infoApprovazione').on('click','.info-box-content', function () {
                window.location.href = "{{action('InterventoController@approvaIntervento')}}";
            });
        });
    </script>
@endsection
