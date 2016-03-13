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


    <div class="col-md-8">
        <div class="box box-primary">
            {!! Form::model($consulente, ['url' => 'consulenti/'.$consulente->id, 'method' => 'PATCH' ]) !!}
            @include('consulenti.partials.consulenteForm')
            {!! Form::close() !!}
        </div>
    </div>


@include('consulenti.partials.consulenteWidget')

@endsection

