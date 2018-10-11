@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Contratto
@endsection
@section('contentheader_title')
    Nuovo Contratto
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
                {!! Form::open(['url' => 'contratti']) !!}
                @include('contratti.partials.contrattoForm')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


