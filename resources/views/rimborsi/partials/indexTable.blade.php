<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Rimborsi</h3>
        <div class="box-tools">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                @if(Auth::User()->id == $user->id OR $user->tipo == 'Partner')
                <button type="button" class="btn btn-default" onClick="location.href='{{ action('RimborsoController@create',$intervento->id) }}'" title="Aggiungi Nuovo ">
                    <i class="fa fa-plus"></i>
                </button>
                @endif
            </div>
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="clienti_search" name="table_search" class="form-control pull-right" placeholder="Search">

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
        <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap hide" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Opzioni</th>
                    <th>Tipo Spesa</th>
                    <th>qta</th>
                    <th>um</th>
                    <th>importo</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $rimborsi as $rimborso)
                <tr>
                    <td>
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <button type="button" class="btn btn-default btn-xs" onClick="location.href='{{action('RimborsoController@edit',[$intervento->id,$rimborso->id])}}'" title="Modifica">
                                <i class="glyphicon glyphicon-edit"></i>
                            </button>
                            <a href="{{ action('RimborsoController@show',[$intervento->id,$rimborso->id]) }}" data-method="DELETE" data-confirm="Eliminare il rimborso?" data-token="{{csrf_token()}}" type="button" class="btn btn-danger btn-xs" })">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </div>
                    </td>
                    <td>{{$rimborso->tipo_spesa}}</td>
                    <td>{{$rimborso->quantita}}</td>
                    <td>{{$rimborso->um}}</td>
                    <td>{{$rimborso->importo}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('page_scripts')
@parent
<script>
    $(document).ready(function() {
        var oTable = $('#clienti').DataTable({
            "scrollY": "280px",
            "scrollCollapse": false,
            "paging": false,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "fnDrawCallback": function() {
                $('#clienti').removeClass('hide');
            }
        });
        $('.dataTables_filter').hide();
        $('#clienti_search').keyup(function() {
            oTable.search($(this).val()).draw();
        })
    });
</script>@append