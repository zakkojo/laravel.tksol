@extends('layouts.app')


@section('htmlheader_title')
        Consulenti
@endsection
@section('contentheader_title')
        Consulenti
@endsection

@section('contentheader_breadcrumb')

@endsection

@section('main-content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Elenco consulenti</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody><tr>
                    <th>CF</th>
                    <th>Nominativo</th>
                    <th>Tipo</th>
                    <th>Ultimo intervento</th>
                    <th>Prossimo intervento</th>
                    <th>Clienti</th>
                    <th>Progetti</th>
                    <th>Interventi pianificati</th>
                </tr>
                <tr>
                    <td>GNTNCL77P27C573Q</td>
                    <td><a href="consulenti/create">Nicola Gentili</a></td>
                    <td>Junior</td>
                    <td>03/04/2016</td>
                    <td><span class="label label-success">04/04/2016</span></td>
                    <td>12</td>
                    <td>24</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>GNTNCL77P27C573Q</td>
                    <td><a href="consulenti/create">Nicola Gentili</a></td>
                    <td>Senior</td>
                    <td>03/04/2016</td>
                    <td><span class="label label-warning">18/04/2016</span></td>
                    <td>1</td>
                    <td>2</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>GNTNCL77P27C573Q</td>
                    <td><a href="consulenti/create">Nicola Gentili</a></td>
                    <td>Partner</td>
                    <td>03/04/2016</td>
                    <td><span class="label label-primary">04/04/2016</span></td>
                    <td>12</td>
                    <td>24</td>
                    <td>9</td>
                </tr>
                <tr>
                    <td>GNTNCL77P27C573Q</td>
                    <td><a href="consulenti/create">Nicola Gentili</a></td>
                    <td>Junior</td>
                    <td>03/04/2016</td>
                    <td><span class="label label-danger">non definito</span></td>
                    <td>3</td>
                    <td>6</td>
                    <td>0</td>
                </tr>
                </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

