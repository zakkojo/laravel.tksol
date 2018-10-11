@extends('layouts.app')


@section('htmlheader_title')
   {{{ $contatto->descrizione }}}
@endsection
@section('contentheader_title')
    {{{ $contatto->descrizione }}}
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
            {!! Form::model($contatto, ['url' => 'contatti/'.$contatto->id, 'method' => 'PATCH' ]) !!}
            @include('contatti.partials.contattoForm')
            {!! Form::close() !!}
        </div>
    </div>

@endsection

