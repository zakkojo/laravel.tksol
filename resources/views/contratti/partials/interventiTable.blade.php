<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tipologia Interventi</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-default"
                        onClick="location.href='{{ action('ContrattoInterventoController@create',$contratto->id) }}'"
                        title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
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
        <table id="listinoInterventi"
               class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <td>Opzioni</td>
                <td>Descrizione</td>
                <td>Tariffa</td>
                <td>IVA</td>
                <td>Ore</td>
                <td>hidden</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listinoInterventi as $listinoIntervento)
                <tr>
                    <td>
                        <a href="{{ action('ContrattoInterventoController@edit',[$contratto->id,$listinoIntervento->id]) }}"
                           data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                            <a href="{{ action('ContrattoInterventoController@destroy',[$contratto->id,$listinoIntervento->id]) }}"
                               data-method="DELETE" data-confirm="Eliminare il listino?" data-token="{{csrf_token()}}"
                               data-skin="skin-blue" class="btn btn-danger btn-xs"><i
                                        class="glyphicon glyphicon-trash"></i></a>
                        @endif

                    </td>
                    <td>{{ $listinoIntervento->descrizione }}</td>
                    <td class="pull-right">
                        {{$listinoIntervento->tariffa_ora}}
                    </td>
                    <td>{{$listinoIntervento->iva}} %, {{ucfirst(strtolower($listinoIntervento->tipo_iva))}}</td>
                    <td>{{ $listinoIntervento->ore_previste }}</td>
                    <td>{{ $listinoIntervento->tariffa_ora*$listinoIntervento->ore_previste }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th colspan="2" style="text-align: right;">Totale Previsto: 0 &euro;</th>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@section('page_scripts')
    <script>
        $(document).ready(function () {
            var clientiTable = $('#listinoInterventi').DataTable({
                "scrollY": "200px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    {"width": "80px", "targets": 0},
                    {
                        "targets": [5],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "fnDrawCallback": function () {
                    $('#listinoInterventi').removeClass('hide');
                },

                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        if (typeof i === 'string') i = Math.floor(i.replace(/[\$,]/g, '') * 1);
                        if (typeof i === 'number') return i;
                        else return 0;
                    };

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Update footer
                    $(api.column(4).footer()).html(
                        'Totale Previsto: ' + Number(total).toLocaleString() + ' &euro;'
                    );
                }
            });
            $('#interventi_search').keyup(function () {
                clientiTable.search($(this).val()).draw();
            })
            $('.dataTables_filter').hide();
        });

    </script>
@append