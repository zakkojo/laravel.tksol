@extends('layouts.app')


@section('htmlheader_title')
    Consulenti
@endsection
@section('contentheader_title')
    Consulenti
    <button type="button" class="btn btn-default navbar-btn"
            onclick="location.href='{{action('ConsulenteController@create')}}'" title="Aggiungi Nuovo">
        <i class="fa fa-plus"></i>&nbsp; Aggiungi Nuovo
    </button>
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco consulenti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="consulenti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="consulenti"
                   class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                   cellspacing="0" width="100%">
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
                            <?php if (count($consulente->user)) $btnclass = 'btn-primary'; else $btnclass = 'btn-default'; ?>
                            <a onclick="toggleUser({{$consulente->id}})" id="consulente_{{$consulente->id}}"
                               data-skin="skin-blue" class="btn btn-xs {{$btnclass}}"><i
                                        class="glyphicon glyphicon-user"></i></a>
                            <a href="{{ action('ConsulenteController@edit',$consulente->id) }}" data-skin="skin-blue"
                               class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
        $(document).ready(function () {
            var oTable = $('#consulenti').DataTable({
                "scrollY": "600px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('.dataTables_filter').hide();
            $('#consulenti_search').keyup(function () {
                oTable.search($(this).val()).draw();
            })
        });
        function toggleUser(id) {
            var conferma = true;
            if ($('#consulente_' + id).hasClass('btn-primary')) {
                conferma = confirm("Disabilitare l'accesso al programma per questo Consulente?");
            }
            if (conferma) {
                var request = $.ajax({
                    url: "/ajax/toggleUser",
                    type: "post",
                    data: {'tipo_utente': 1, 'id': id},
                    dataType: "JSON"
                }).done(function (data) {
                    if (data['status'] == 'success'){
                        if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                        else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                        console.log(data['msg']);
                    }
                    else if(data['status'] == 'warning') {

                        if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                        else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                        console.log(['Warning!', data]);
                    }
                    else console.log(['Errore!!', data]);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
        }

    </script>
@endsection
