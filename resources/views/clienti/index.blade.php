@extends('layouts.app')


@section('htmlheader_title')
    Clienti
@endsection
@section('contentheader_title')
    Clienti
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco clienti</h3>
            <div class="box-tools">
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="btn btn-default"
                            onClick="location.href='{{ action('ClienteController@create') }}'" title="Aggiungi Nuovo ">
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
            <table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
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
                @foreach($clienti as $cliente)
                    <tr>
                        <td>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <button type="button" class="btn btn-default btn-xs"
                                        onClick="location.href='{{ action('ClienteController@edit',$cliente->id) }}'"
                                        title="Modifica">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>
                                @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                                    <a href="{{ action('ClienteController@destroy',$cliente->id) }}"
                                       data-method="DELETE" data-confirm="Eliminare il Cliente?"
                                       data-token="{{csrf_token()}}" data-skin="skin-blue"
                                       class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                        <td>{{ $cliente->codice_fiscale }}<br/>{{ $cliente->partita_iva }}</td>
                        <td>
                            <a href="{{ action('ClienteController@show',$cliente->id) }}">{{ $cliente->ragione_sociale }}</a>
                        </td>
                        <td>{{ $cliente->settore }}</td>
                        <td class="pull-right"><i
                                    class="glyphicon glyphicon-euro"></i> {{ number_format($cliente->fatturato,0,',','.') }}
                            mln
                        </td>
                        <td>
                            <a href="http://maps.google.com/?q={{ $cliente->indirizzo . ', ' . $cliente->citta . ', ' . $cliente->ragione_sociale}}"
                               target="crm.tksol.map">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                {{ $cliente->citta }}
                            </a>
                        </td>
                        <td>{{ $cliente->rating }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            var oTable = $('#clienti').DataTable({
                "scrollY": "500px",
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
