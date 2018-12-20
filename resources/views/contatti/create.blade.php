@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Contatto
@endsection
@section('contentheader_title')
    Nuovo Contatto @if(isset($cliente)) per {{$cliente->ragione_sociale}} @endif
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
                {!! Form::open(['url' => 'contatti']) !!}
                {!! Form::hidden('cliente_id', $cliente->id) !!}
                @include('contatti.partials.contattoForm')
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

