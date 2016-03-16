@extends('layouts.app')


@section('htmlheader_title')
    {{$cliente->ragione_sociale}}
@endsection
@section('contentheader_title')
    {{$cliente->ragione_sociale}}
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rubrica</h3>

                    <div class="box-tools">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button type="button" class="btn btn-default"
                                    onClick="location.href='{{ action('ClienteController@associa',$cliente->id) }}'"
                                    title="Aggiungi Nuovo ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="clienti_search" name="table_search"
                                       class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->

                <!-- /.box-body -->
                <div class="box-body">
                    <table id="clienti"
                           class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <td>Opzioni</td>
                            <td>Ragione Sociale</td>
                            <td>Città</td>
                            <td>Telefono</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cliente->rubrica as $contatto)
                            <tr>
                                <td>
                                    <?php if (count($contatto->user)) $btnclass = 'btn-primary'; else $btnclass = 'btn-default'; ?>
                                    <a onclick="toggleUser({{$contatto->id}})" id="consulente_{{$contatto->id}}"
                                       data-skin="skin-blue" class="btn btn-xs {{$btnclass}}"><i
                                                class="glyphicon glyphicon-user"></i></a>
                                    <a href="{{ action('ContattoController@edit',$contatto->id) }}"
                                       data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-trash"></i></a>

                                </td>
                                <td>{{ $contatto->descrizione }}</td>
                                <td>{{ $contatto->citta }}</td>
                                <td>{{ $contatto->telefono }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contratti</h3>
                    <div class="box-tools">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button type="button" class="btn btn-default"
                                    onClick="location.href='{{ action('ClienteController@associa',$cliente->id) }}'"
                                    title="Aggiungi Nuovo ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="clienti_search" name="table_search"
                                       class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="contratti"
                           class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <td>Opzioni</td>
                            <td>Progetto</td>
                            <td>Inizio</td>
                            <td>Durata</td>
                            <td>Stato</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cliente->contratti as $contratto)
                            <tr>
                                <td>
                                    <a href="{{ action('ContattoController@edit',$contratto->id) }}"
                                       data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-trash"></i></a>

                                </td>
                                <td>{{ $contratto->progetto->nome }}</td>
                                <td>{{ $contratto->data_avvio_progetto }}</td>
                                <td>{{ $contratto->data_validita_contratto }}</td>
                                <td>{{ $contratto->stato }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            $('.dataTables_filter').hide();
            //Script Tabella Rubrica
            var clientiTable = $('#clienti').DataTable({
                "scrollY": "600px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('#clienti_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            //Script Tabella Contratti
            var contrattiTable = $('#contratti').DataTable({
                "scrollY": "600px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    { "width": "80px", "targets": 0 }
                ]
            });
            $('.dataTables_filter').hide();
            $('#clienti_search').keyup(function () {
                contrattiTable.search($(this).val()).draw();
            })
        });

        function toggleUser(id) {
            var request = $.ajax({
                url: "/ajax/toggleUser",
                type: "post",
                data: {'tipo_utente': 2, 'id': id},
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                    else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                    console.log(data['msg']);
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    </script>
@endsection

