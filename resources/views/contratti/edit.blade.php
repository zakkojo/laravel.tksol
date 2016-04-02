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
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-4">
        <div class="row">
            <div class="box box-primary">
                {!! Form::model($contratto, ['url' => 'contratti/'.$contratto->id, 'method' => 'PATCH' ]) !!}
                @include('contratti.partials.contrattoForm')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <?php  $interventi = $contratto->progetto->prodotti; ?>
                    @include('contratti.partials.interventiTable')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <?php $prodotti = $contratto->progetto->interventi; ?>
                    @include('contratti.partials.prodottiTable')
                </div>
            </div>
        </div>
    </div>
@endsection

