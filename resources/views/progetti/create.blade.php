@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Progetto
@endsection
@section('contentheader_title')
    Nuovo Progetto
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
    <div class="row" ;>
        <div class="col-md-3" ;>
            {!! Form::open(['url' => 'progetti']) !!}
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nuovo Progetto</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>Area</label>
                        {!! Form::text('area', null,['class'=>'form-control', 'id'=>'descrizione']) !!}
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        {!! Form::text('nome', null,['class'=>'form-control', 'id'=>'parent_id']) !!}
                    </div>
                    <div class="form-group">
                        <label>Codice</label>
                        {!! Form::text('codice', null,['class'=>'form-control', 'id'=>'progetto_id']) !!}
                    </div>

                </div>
                <div class="box-footer">
                    <button id="btn-submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection


