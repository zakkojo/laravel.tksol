@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Intervento
@endsection
@section('contentheader_title')
    Rapportino
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
            <div class="row">
                <div class="col-md-12">
                    @include('interventi.partials.progettocliente')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('interventi.partials.consulente')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    @include('interventi.partials.intervento')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('rimborsi.partials.indexTable')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('interventi.partials.textarea')
    </div>
    <button type="submit" class="btn btn-block btn-primary">Submit</button>
@endsection
@section('page_scripts')

@endsection
