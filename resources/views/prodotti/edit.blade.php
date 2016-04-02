@extends('layouts.app')
@section('htmlheader_title')
    {{ $prodotto->nome }}
@endsection
@section('contentheader_title')
    Prodotto: {{ $prodotto->nome}}
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
                {!! Form::model($prodotto, ['action' => ['ProdottoController@update', $prodotto->id], 'method' => 'PATCH' ]) !!}
                @include('prodotti.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

