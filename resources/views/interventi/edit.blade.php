@extends('layouts.app')


@section('htmlheader_title')
    Dettaglio Intervento
@endsection
@section('contentheader_title')
    Dettaglio Intervento
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
    {!! Form::model($intervento, ['action' => ['InterventoController@update', $intervento->id], 'method' => 'PATCH' ]) !!}
    <div class="row">
        <div class="col-md-6">
            @include('interventi.partials.riepilogoForm')
        </div>
        <div class="col-md-6">
            @include('rimborsi.partials.indexTable')
        </div>
    </div>
    <div class="row">
        @include('interventi.partials.textarea')
    </div>
    <button type="submit" class="btn btn-block btn-primary">Submit</button>
    {!! Form::close() !!}
@endsection
@section('page_scripts')

@endsection
