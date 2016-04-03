@extends('layouts.app')


@section('htmlheader_title')
@endsection
@section('contentheader_title')
    Gestione Attività di Progetto
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
    <div class="col-md-4">
        @include('progetti.partials.treeView')
    </div>
    <div class="col-md-5">
        {!! Form::model($progetto, ['url' => 'attivita', 'method' => 'PATCH' ]) !!}
            @include('progetti.partials.contrattoForm')
        {!! Form::close() !!}
    </div>
</div>
@endsection

