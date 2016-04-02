@extends('layouts.app')


@section('htmlheader_title')
    Nuovo Prodotto
@endsection
@section('contentheader_title')
    Nuovo Prodotto
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
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
            {!! Form::open(['action' => 'ProdottoController@store']) !!}
            @include('prodotti.partials.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('page_scripts')
    <script></script>
@endsection


