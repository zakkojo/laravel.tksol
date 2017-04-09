<div class="box">
    <div class="box-header">
        <h3 class="box-title">Contratti Senza Interventi</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="contratti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="contrattiSenzaInterventi"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Cliente</td>
                <td>Progetto</td>
                <td>Ultimo Intervento</td>
            </tr>
            </thead>
            <tbody>
            @foreach($contrattiSenzaInterventi as $contrattoSenzaIntervento)
                <tr>
                    <td>
                        <a href="{{ action('InterventoController@create',['contratto' =>$contrattoSenzaIntervento->contratto_id]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                    class="glyphicon glyphicon-calendar"></i></a>
                    </td>
                    <td>{{ $contrattoSenzaIntervento->ragione_sociale }}</td>
                    <td class="pull-right">{{$contrattoSenzaIntervento->nome}}</td>
                    <td>{{$contrattoSenzaIntervento->data_primo_intervento}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@section('page_scripts')
    @parent
    <script>
        $(document).ready(function () {
            var clientiTable = $('#contrattiSenzaInterventi').DataTable({
                "scrollY": "200px",
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
                    $('#contrattiSenzaInterventi').removeClass('hide');
                }

            });
            $('#contratti_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });
    </script>
@endsection