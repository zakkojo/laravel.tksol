@extends('layouts.app')


@section('htmlheader_title')
        Consulenti
@endsection
@section('contentheader_title')
        Consulenti
        <button type="" class="btn btn-primary btn-block btn-flat">Nuovo consulente</button>
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
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
            <table id="consulenti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>CF</th>
                        <th>Nominativo</th>
                        <th>Tipo</th>
                        <th>Mail</th>
                        <th>Telefono</th>
                        <th>Ultimo intervento</th>
                        <th>Prossimo intervento</th>
                        <th>Clienti</th>
                        <th>Progetti</th>
                        <th>Interventi pianificati</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $consulenti as $consulente)
                <tr>
                    <td>{{ $consulente->codice_fiscale }}</td>
                    <td>
                        <a href="{{ action('ConsulenteController@edit',$consulente->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        {{ $consulente->nome . " " . $consulente->cognome }}
                    </td>
                    <td>{{ $consulente->tipo }}</td>
                    <td>{{ $consulente->mail }}</td>
                    <td>{{ $consulente->mobile . " " . $consulente->mobile2  }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function() {
            var oTable = $('#consulenti').DataTable({
                "scrollY": "600px",
                "scrollCollapse": false,
                "paging":         false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('.dataTables_filter').hide();
            $('#consulenti_search').keyup(function(){
                oTable.search($(this).val()).draw() ;
            })
        });
    </script>
@endsection
