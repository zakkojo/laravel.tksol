@extends('layouts.app')


@section('htmlheader_title')
    {{{ $consulente->nome." ".$consulente->cognome }}}
@endsection
@section('contentheader_title')
    @if($consulente->id)
        {{{ $consulente->nome." ".$consulente->cognome}}}
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
        <div class="col-md-6">
            <div class="box box-primary">
                {!! Form::model($consulente, ['url' => 'consulenti/'.$consulente->id, 'method' => 'PATCH' ]) !!}
                @include('consulenti.partials.consulenteForm')
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                @include('consulenti.partials.googleForm')
            </div>
        </div>
    </div>
@endsection

