<div class="box">
    <div class="box-header">
        <h3 class="box-title">Interventi da approvare</h3>
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
        <table id="interventiDaApprovare"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Richiedente</td>
                <td>Cliente</td>
                <td>Progetto</td>
                <td>Data</td>
                <td>Orario</td>
            </tr>
            </thead>
            <tbody>
            @foreach($interventiDaApprovare as $intervento)
                <tr>
                    <td>
                        <a href="{{ action('InterventoController@create',['data' =>$intervento->dataC]) }}"
                           title="vai al calendario" data-skin="skin-blue" class="btn btn-default btn-xs"><i
                                    class="glyphicon glyphicon-calendar"></i></a>
                        <a href="#" onclick="acceptIntervento($(this).parent(),{{$intervento->id}})" title="accetta appuntamento"
                           data-skin="skin-blue" class="btn btn-success btn-xs"><i
                                    class="glyphicon glyphicon-ok"></i></a>


                    </td>
                    <td>{{ $intervento->creatore->nominativo }}</td>
                    <td>{{ $intervento->listinoInterventi->contratto->cliente->ragione_sociale }}</td>
                    <td>{{ $intervento->listinoInterventi->contratto->progetto->descrizione}}</td>
                    <td class="pull-right">{{$intervento->data}}</td>
                    <td>{{ $intervento->orario }}</td>
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
            var clientiTable = $('#interventiDaApprovare').DataTable({
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
                    $('#interventiDaApprovare').removeClass('hide');
                }

            });
            $('#contratti_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });

        function acceptIntervento(element,id) {
            if (confirm("Cancellare l'appuntamneto selezionato?")) {
                $.ajax({
                    url: "/ajax/interventi/acceptIntervento",
                    type: "GET",
                    data: {id: id},
                    dataType: "JSON"
                }).done(function (data) {
                    if (data['status'] == 'success'){
                        element.hide();
                    }
                    else console.log(['Errore!!', data]);
                }).fail(function (jqXHR, textStatus) {
                    alert("Request failed: " + textStatus);
                });
            }
        }

    </script>
@endsection