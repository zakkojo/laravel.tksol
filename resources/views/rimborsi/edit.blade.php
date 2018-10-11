@extends('layouts.app')


@section('htmlheader_title')
    Rimborso
@endsection
@section('contentheader_title')
    Rimborso
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
                {!! Form::model($rimborso, ['action' => ['RimborsoController@update', $rimborso->intervento_id,$rimborso->id], 'method' => 'PATCH' ]) !!}
                @include('rimborsi.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')

@endsection