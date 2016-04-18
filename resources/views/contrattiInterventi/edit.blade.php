@extends('layouts.app')


@section('htmlheader_title')
    {{ $contratto->cliente->ragione_sociale }}
@endsection
@section('contentheader_title')
    Contratto {{ $contratto->cliente->ragione_sociale}}
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="row">
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


            <div class="row">
                <div class="box box-primary">
                    {!! Form::model($listinoIntervento, ['action' => ['ContrattoInterventoController@update', $contratto->id,$listinoIntervento->id], 'method' => 'PATCH' ]) !!}
                    @include('contrattiInterventi.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

