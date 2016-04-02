@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Rimborso
@endsection
@section('contentheader_title')
    Rimborso
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="col-md-6">
        @include('rimborsi.partials.form')
    </div>
@endsection
@section('page_scripts')

@endsection