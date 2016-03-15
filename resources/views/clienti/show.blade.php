@extends('layouts.app')


@section('htmlheader_title')
        Cliente
@endsection
@section('contentheader_title')
        Cliente &nbsp;
        <button type="button" class="btn btn-default navbar-btn" onClick="location.href='{{ action('ClienteController@associa',$cliente->id) }}'" title="Aggiungi Nuovo">
            <i class="fa fa-plus"></i>&nbsp; Aggiungi Contatto
        </button>

@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco contatti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" id="clienti_search" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->

        <!-- /.box-body -->
        <div class="box-body">
        <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
            <thead>
            <tr>
                <td>Ragione Sociale </td>
                <td>Città</td>
                <td>Telefono</td>
                <td>Opzioni</td>
            </tr>
            </thead>
            <tbody>
            @foreach($cliente->rubrica as $contatto)
                <tr>
                    <td>{{ $contatto->descrizione }}</td>
                    <td>{{ $contatto->citta }}</td>
                    <td>{{ $contatto->telefono }}</td>
                    <td>
                        <?php if(count($contatto->user)) $btnclass = 'btn-primary'; else $btnclass = 'btn-default'; ?>
                        <a onclick="toggleUser({{$contatto->id}})" id="consulente_{{$contatto->id}}" data-skin="skin-blue" class="btn btn-xs {{$btnclass}}"><i class="glyphicon glyphicon-user"></i></a>
                        <a href="{{ action('ContattoController@edit',$contatto->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="#" data-skin="skin-blue" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        var oTable = $('#clienti').DataTable({
            "scrollY": "600px",
            "scrollCollapse": false,
            "paging":         false,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('.dataTables_filter').hide();
        $('#clienti_search').keyup(function(){
            oTable.search($(this).val()).draw() ;
        })
    });

    function toggleUser(id){
        var request = $.ajax({
            url: "/ajax/toggleUser",
            type: "get",
            data: {'tipo_utente':2,'id':id},
            dataType: "JSON"
        }).done(function( data ) {

            if($('#consulente_'+id).hasClass('btn-primary')) $('#consulente_'+id).removeClass('btn-primary').addClass('btn-default');
            else $('#consulente_'+id).removeClass('btn-default').addClass('btn-primary');
            console.log(data['msg']);
        }).fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    }
</script>
@endsection

