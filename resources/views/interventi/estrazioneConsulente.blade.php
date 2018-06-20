@extends('layouts.app')


@section('htmlheader_title')
    Estrazione Interventi
@endsection
@section('contentheader_title')
    Estrazione Interventi
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
            <div class="box-header with-border">
                <h3 id="form_title" class="box-title">Filtri</h3>
            </div>
            {{ Form::open(['url' => 'interventi/estrazioneXlsx', 'method' => 'GET' ]) }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Da:</label>
                            <div><input name="di" size='10' type='text' id='di' class="datepicker"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>A:</label>
                            <div><input name="df" size='10' type='text' id='df' class="datepicker"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button id="inviaBtn" type="submit"  class="btn  btn-primary"><i
                            class="fa fa-download"></i>&nbsp; Estrai
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            if($('#di').val()=="") {
                $('#di').val(moment().startOf('month').format('L'));
                $('#df').val(moment().endOf('month').format('L'));
            }
        });
    </script>
@endsection

