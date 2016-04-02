@extends('layouts.app')


@section('htmlheader_title')
@endsection
@section('contentheader_title')
    Gestione Attivita di Progetto
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
        @include('progetti.partials.treeView')
    </div>
    <div class="col-md-6">
            @include('progetti.partials.contrattoForm')
    </div>
</div>
@endsection

