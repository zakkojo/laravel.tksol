<div class="box ">
    <div class="box-header">
        <h3 class="box-title">Prossimi Interventi</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="interventi_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="prossimiInterventi"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Opzioni</th>
                <th>Cliente</th>
                <th>Attività</th>
                <th>Stato</th>
                <th>Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $consulente->interventi as $intervento)
                <tr>
                    <td>
                        <a href="{{ action('InterventoController@create',['data' =>$intervento->dataC]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                    class="glyphicon glyphicon-calendar"></i></a>
                        <a href="{{ action('InterventoController@edit',[$intervento->id]) }}" data-skin="skin-blue"
                           class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td>{{ $intervento->listinoInterventi->contratto->cliente->ragione_sociale}}</td>
                    <td>{{ $intervento->attivita->descrizione }}</td>
                    <td>{{ $intervento->stato }}</td>
                    <td>{{ $intervento->data }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@section('page_scripts')
    @parent
    <script>
        $(document).ready(function () {
            var clientiTable = $('#prossimiInterventi').DataTable({
                "scrollY": "400px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"width": "80px", "targets": 0}
                ],
                "fnDrawCallback": function () {
                    $('#prossimiInterventi').removeClass('hide');
                }

            });
            $('#interventi_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });
    </script>
@endsection