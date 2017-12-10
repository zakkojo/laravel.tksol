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
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">93,139</span>
                    <span class="info-box-button">93,139</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
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

