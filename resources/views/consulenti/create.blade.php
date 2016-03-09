@extends('layouts.app')


@section('htmlheader_title')
        CRM.Tksol - Nicola Gentili
@endsection
@section('contentheader_title')
        Nicola Gentili
@endsection

@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="col-md-8">
        <div class="box box-primary">
            {!! Form::open(array('route' => 'consulenti.create', 'method' => 'POST')) !!}
            <div class="box-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="codice_fiscale" placeholder="Codice fiscale">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <div><input type="text" class="form-control" id="cognome" placeholder="Cognome"></div>
                        <div><input type="text" class="form-control" id="nome" placeholder="Nome"></div>
                    </div>
                    <div class="form-group">
                        <div><input type="text" class="form-control" id="indirizzo" placeholder="Indirizzo"></div>
                        <div><input type="text" class="form-control" id="citta" placeholder="Città"></div>
                        <div><input type="text" class="form-control" id="provincia" placeholder="Provincia"></div>
                        <div><input type="text" class="form-control" id="cap" placeholder="Cap"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="telefono1" placeholder="Telefono">
                        <input type="text" class="form-control" id="telefono" placeholder="2° telefono">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobile" placeholder="Mobile">
                        <input type="text" class="form-control" id="mobile2" placeholder="2°mobile">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="partita_iva" placeholder="Partita IVA">
                    </div>
                    <div class="form-group">
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option>Tipo consulente</option>
                            <option>Partner</option>
                            <option>Senior</option>
                            <option>Junior</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Allega curriculum</label>
                        <input type="file" id="exampleInputFile">

                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Check me out
                        </label>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">Nicola Gentili</h3>
                <h5 class="widget-user-desc">Partner</h5>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Progetti <span class="pull-right badge bg-blue">31</span></a></li>
                    <li><a href="#">Attività <span class="pull-right badge bg-aqua">5</span></a></li>
                    <li><a href="#">Clienti <span class="pull-right badge bg-green">12</span></a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection

