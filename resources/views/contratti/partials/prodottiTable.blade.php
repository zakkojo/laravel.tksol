<div class="box">
    <div class="box-header">
        <h3 class="box-title">Listino Prodotto</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-default"
                        onClick="location.href='{{ action('ContrattoProdottoController@create',$contratto->id) }}'"
                        title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="prodotti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body" style="min-height: 300px;">
        <table id="listinoProdotti"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap hide"
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Prodotto</td>
                <td>Importo</td>
                <td>IVA</td>
                <td>Fee</td>
                <td>Softwarehouse</td>
                <td>Tipo</td>
                <td>Scadenza</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listinoProdotti as $listinoProdotto)
                <tr>
                    <td>
                        <a href="{{ action('ContrattoProdottoController@edit',[$contratto->id,$listinoProdotto->id]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i
                                    class="glyphicon glyphicon-trash"></i></a>

                    </td>
                    <td>{{ $listinoProdotto->prodotto->nome }}</td>
                    <td class="pull-right">
                        <i class="glyphicon glyphicon-euro"></i> {{$listinoProdotto->importo}}
                    </td>
                    <td>{{$listinoProdotto->iva}} %, {{ucfirst(strtolower($listinoProdotto->tipo_iva))}}</td>
                    <td>{{ $listinoProdotto->fee }}</td>
                    <td>{{ $listinoProdotto->softwarehouse->ragione_sociale }}</td>
                    <td>{{ $listinoProdotto->tipo_vendita }}</td>
                    <td>{{ $listinoProdotto->scadenza }}</td>
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
            var clientiTable = $('#listinoProdotti').DataTable({
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
                    $('#listinoProdotti').removeClass('hide');
                }

            });
            $('#prodotti_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });
    </script>
@endsection