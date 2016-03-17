@extends('layouts.app')


@section('htmlheader_title')
    {{ $contratto->ragione_sociale }}
@endsection
@section('contentheader_title')
    {{ $contratto->ragione_sociale}}
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

    <div class="col-md-8">
        <div class="row">
            <div class="box box-primary">
                {!! Form::model($contratto, ['url' => 'contratti/'.$contratto->id, 'method' => 'PATCH' ]) !!}
                @include('contratti.partials.contrattoForm')
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

