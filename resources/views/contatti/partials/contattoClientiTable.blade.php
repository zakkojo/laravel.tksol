<div class="box ">
    <div class="box-header">
        <h3 class="box-title">Clienti Associati</h3>
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
        <table id="clientiContatto"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th></th>
                <th>Cliente</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clientiContatto as $clienteContatto)
                <tr>
                    <td>
                        @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                            <a href="{{ action('ClienteContattoController@destroy',$clienteContatto->id) }}"
                               data-method="DELETE" data-confirm="Eliminare il Contatto dalla rubrica del cliente selezionato?"
                               data-token="{{csrf_token()}}" data-skin="skin-blue"
                               class="btn btn-default btn-xs"><i class="fas fa-unlink"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ action('ClienteController@show',$clienteContatto->cliente->id) }}">{{ $clienteContatto->cliente->ragione_sociale }}</a>
                    </td>
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
            var clientiTable = $('#clientiContatto').DataTable({
                "scrollY": "400px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"width": "20px", "targets": 0}
                ],
                "fnDrawCallback": function () {
                    $('#clientiContatto').removeClass('hide');
                }

            });
            $('#interventi_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });
    </script>
@endsection