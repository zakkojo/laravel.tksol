@extends('layouts.app')


@section('htmlheader_title')
    Programma Interventi
@endsection
@section('contentheader_title')
    Programma Interventi
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
        <div class="col-md-8">
            @include('interventi.partials.calendar')
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    @include('interventi.partials.pianificaForm')
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page_scripts')

@endsection
