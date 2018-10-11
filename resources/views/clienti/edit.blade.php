@extends('layouts.app')


@section('htmlheader_title')
    {{ $cliente->ragione_sociale }}
@endsection
@section('contentheader_title')
    {{ $cliente->ragione_sociale}}
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
        <div class="col-md-6">
            <div class="box box-primary">
                {!! Form::model($cliente, ['url' => 'clienti/'.$cliente->id, 'method' => 'PATCH' ]) !!}
                @include('clienti.partials.clienteForm')

            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                @include('clienti.partials.idGammaForm')

            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection

