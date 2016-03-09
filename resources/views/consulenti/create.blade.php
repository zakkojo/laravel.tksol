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
    <div style="width:50%">
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

