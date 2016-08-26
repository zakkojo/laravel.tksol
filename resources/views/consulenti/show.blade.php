@extends('layouts.app')


@section('htmlheader_title')
    DASHBOARD {{{ $consulente->nome." ".$consulente->cognome }}}
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
            @include('consulenti.partials.prossimiInterventi')
        </div>
        <div class="col-md-6">
            @include('consulenti.partials.contrattiSenzaInterventi')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('consulenti.partials.interventiDaApprovare')
        </div>
    </div>
@endsection

