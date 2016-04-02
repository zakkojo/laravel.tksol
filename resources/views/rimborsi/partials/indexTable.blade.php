<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Rimborsi</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-default"
                        onClick="location.href='{{action('RimborsoController@create')}}'" title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="clienti_search" name="table_search" class="form-control pull-right"
                           placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->

    <!-- /.box-body -->
    <div class="box-body" style="min-height: 300px;">
        <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap hide"
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Codice Fiscale<br/>Partita IVA</td>
                <td>Ragione Sociale</td>
                <td>Settore</td>
                <td>Fatturato</td>
                <td>Città</td>
                <td>Rating</td>
            </tr>
            </thead>
            <tbody>
            @foreach(range(0, 12) as $cliente)
                <tr>
                    <td>
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <button type="button" class="btn btn-default btn-xs"
                                    onClick="location.href='{{action('RimborsoController@create')}}'" title="Modifica">
                                <i class="glyphicon glyphicon-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" onClick="" title="Elimina">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>Lorem <br/>Ipsum</td>
                    <td>Lorem Ispum</td>
                    <td>Lorem Ispum</td>
                    <td>Lorem Ispum</td>
                    <td>Lorem Ispum</td>
                    <td>Lorem Ispum</td>
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
            var oTable = $('#clienti').DataTable({
                "scrollY": "280px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "fnDrawCallback": function () {
                    $('#clienti').removeClass('hide');
                }
            });
            $('.dataTables_filter').hide();
            $('#clienti_search').keyup(function () {
                oTable.search($(this).val()).draw();
            })
        });
    </script>
@endsection