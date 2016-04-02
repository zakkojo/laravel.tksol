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
                {!! Form::model($listinoProdotto, ['action' => ['ContrattoProdottoController@update', $contratto->id,$listinoProdotto->id], 'method' => 'PATCH' ]) !!}
                @include('contrattiProdotti.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

