@extends('layouts.app')

@section('htmlheader_title')
    Dettaglio Intervento
@endsection
@section('contentheader_title')
    Dettaglio Intervento
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
    {!! Form::model($intervento, ['action' => ['InterventoController@update', $intervento->id], 'method' => 'PATCH','class'=>'riepilogoForm' ]) !!}
    <div class="row">
        <div class="col-md-6">
            @include('interventi.partials.riepilogoForm')
        </div>
        <div class="col-md-6">
            @include('rimborsi.partials.indexTable')
        </div>
    </div>
    <div class="row">
        @include('interventi.partials.textarea')
    </div>
    @if($intervento->stampa == 0 )
    <div class="btn-group btn-block">
        @if(Auth::User()->consulente->id == $consulente->id)
            <button type="aggiorna" class="col-md-6 btn btn-success"><i class="fa fa-remove"></i> Aggiorna
        </button>
        <button type="stampa" value="stampa" class="stampaButton col-md-6 btn btn-primary"><i class="fa fa-calendar"></i>
            Salva e Stampa
        </button>
        @endif
    </div>
    @elseif($intervento->stampa == 1 )
        <a href="{{ action('InterventoController@show',$intervento->id) }}" type="stampa" value="stampa" class="btn-block btn btn-primary"><i class="fa fa-calendar"></i>
            Invio e Stampa
        </a>
    @endif
    {!! Form::close() !!}
@endsection
@section('page_scripts')
    <script>
        var submitvalue;
        $('.stampaButton').click(function () {
            $('<input />').attr('type', 'hidden')
                    .attr('name', "stampa")
                    .attr('value', "1")
                    .appendTo('.riepilogoForm');
        });
    </script>
@endsection
