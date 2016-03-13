@extends('layouts.app')


@section('htmlheader_title')
   Nuovo Cliente
@endsection
@section('contentheader_title')
    Nuovo Cliente
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
            {!! Form::open(['url' => 'clienti']) !!}
            @include('clienti.partials.clienteForm')
            {!! Form::close() !!}
        </div>
    </div>

@endsection


