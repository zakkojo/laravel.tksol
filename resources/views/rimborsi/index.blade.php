@extends('layouts.app')


@section('htmlheader_title')
    Indice Rimborsi
@endsection
@section('contentheader_title')
    Indice Rimborsi
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="col-lg-6">
        <div class="row">
            @include('rimborsi.partials.indexTable')
        </div>
    </div>
@endsection

@section('page_scripts')

@endsection