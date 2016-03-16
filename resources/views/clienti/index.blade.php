@extends('layouts.app')


@section('htmlheader_title')
        Clienti
@endsection
@section('contentheader_title')
        Clienti &nbsp;
        <button type="button" class="btn btn-default navbar-btn" onClick="location.href='clienti/create'" title="Aggiungi Nuovo">
            <i class="fa fa-plus"></i>&nbsp; Aggiungi Nuovo
        </button>
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco clienti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="clienti_search" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <!-- /.box-body -->
        <div class="box-body">
        <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>Ragione Sociale </td>
                <td>Cliente</td>
                <td>Software house</td>
                <td>Città</td>
                <td>Telefono</td>
                <td>Opzioni</td>
            </tr>
            </thead>
            <tbody>
            @foreach($clienti as $cliente)
                <tr>
                    <td>{{ $cliente->ragione_sociale }}</td>
                    <td>{{ $cliente->software_house }}</td>
                    <td>{{ $cliente->cliente }}</td>
                    <td>{{ $cliente->citta }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <a href="{{ action('ClienteController@show',$cliente->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ action('ClienteController@edit',$cliente->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        var oTable = $('#clienti').DataTable({
            "scrollY": "600px",
            "scrollCollapse": false,
            "paging":         false,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('.dataTables_filter').hide();
        $('#clienti_search').keyup(function(){
            oTable.search($(this).val()).draw() ;
        })
    });
</script>
@endsection
