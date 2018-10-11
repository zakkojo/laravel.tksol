@extends('layouts.app')


@section('htmlheader_title')
    Associa Consulente
@endsection
@section('contentheader_title')
    Associa Consulente per Contratto
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box box-primary">
                {!! Form::model($consulenteContratto, ['action' => ['ConsulenteContrattoController@update', $consulenteContratto->contratto_id,$consulenteContratto->id], 'method' => 'PATCH' ]) !!}
                <input type="hidden" name="id" value= {{ $consulenteContratto->id }}>
                @include('consulentiContratti.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

