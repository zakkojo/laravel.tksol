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

    <div class="col-md-8">
        <div class="box box-primary">
            {!! Form::open(['url' => 'contatti']) !!}
            @include('contatti.partials.contattoForm')
            {!! Form::close() !!}
        </div>
    </div>

@endsection

