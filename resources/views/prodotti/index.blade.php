@extends('layouts.app')


@section('htmlheader_title')
    Prodotti
@endsection
@section('contentheader_title')
    Prodotti &nbsp;
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="row col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Elenco Prodotti</h3>
                <div class="box-tools">
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <button type="button" class="btn btn-default"
                                onClick="location.href='{{ action('ProdottoController@create') }}'"
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
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-body">
                <table id="prodotti"
                       class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <td>Opzioni</td>
                        <td>Nome</td>
                        <td>Codice</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prodotti as $prodotto)
                        <tr>
                            <td>
                                <a href="{{ action('ProdottoController@edit',$prodotto->id) }}" data-skin="skin-blue"
                                   class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
                                    <a href="{{ action('ProdottoController@destroy',$prodotto->id) }}"
                                       data-method="DELETE" data-confirm="Eliminare il prodotto?"
                                       data-token="{{csrf_token()}}" data-skin="skin-blue"
                                       class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                @endif

                            </td>
                            <td>{{ $prodotto->nome }}</td>
                            <td>{{ $prodotto->codice }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function () {
            var oTable = $('#prodotti').DataTable({
                "scrollY": "280px",
                "scrollCollapse": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
            $('.dataTables_filter').hide();
            $('#prodotti_search').keyup(function () {
                oTable.search($(this).val()).draw();
            })
        });
    </script>
@endsection
