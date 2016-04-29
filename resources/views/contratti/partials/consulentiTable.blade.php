<div class="box">
    <div class="box-header">
        <h3 class="box-title">Consulenti</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-default"
                        onClick="location.href='{{ action('ConsulenteContrattoController@create',$contratto->id) }}'"
                        title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="consulenti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="consulenti"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap " cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Consulente</td>
                <td>Ruolo</td>
            </tr>
            </thead>
            <tbody>
            @foreach($consulentiContratto as $consulenteContratto)
                <tr>
                    <td>
                        <a href="{{ action('ConsulenteContrattoController@edit',[$contratto->id,$consulenteContratto->id]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i
                                    class="glyphicon glyphicon-trash"></i></a>

                    </td>
                    <td>{{ $consulenteContratto->consulente->nominativo }}</td>
                    <td>{{ $consulenteContratto->ruolo }}</td>
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
            var clientiTable = $('#consulenti').DataTable({
                "scrollY": "200px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    { "width": "80px", "targets": 0 }
                ],
                "fnDrawCallback":function(){
                    $('#listinoInterventi').removeClass('hide');
                }

            });
            $('#consulenti_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });
    </script>
@endsection