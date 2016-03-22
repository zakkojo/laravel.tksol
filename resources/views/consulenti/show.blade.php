@extends('layouts.app')


@section('htmlheader_title')
    DASHBOARD {{{ $consulente->nome." ".$consulente->cognome }}}
@endsection
@section('contentheader_title')
    @if($consulente->id)
        {{{ $consulente->nome." ".$consulente->cognome}}}
    @else
        Nuovo Utente
    @endif
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

<div class="col-md-8">
    <div class="box ">
        <div class="box-header">
            <h3 class="box-title">Elenco consulenti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="consulenti_search" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="interventi" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Attività</th>
                    <th>Stato</th>
                    <th>Data</th>
               </tr>
                </thead>
                <tbody>
                @foreach( $consulente->interventi as $intervento)
                    <tr>
                        <td>{{ $intervento->cliente}}</td>
                        <td>{{ $intervento->descrizione }}</td>
                        <td>{{ $intervento->stato }}</td>
                        <td>{{ $intervento->data }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>

    @include('consulenti.partials.consulenteWidget')

@endsection

