@extends('layouts.app')


@section('htmlheader_title')
        Nuovo Utente
@endsection
@section('contentheader_title')
        Gestione Utenti
@endsection

@section('contentheader_breadcrumb')
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href=" {{ url('user') }} "> Gestione Utenti</a></li>
        <li class="active">Nuovo Utente</li>
    </ol>
@endsection

@section('main-content')

    {!! Form::open(['url' => 'user']) !!}
	<div class="container spark-screen">
		<div class="row">


            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuovo Utente</h3>
                </div>
                <div class="box-body">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nome Cognome" name="name">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Email"name="email">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Conferma Password" name="confermaPassword">
                    </div>
                    <br>
                    @can('creaUtente')
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Crea Utente</button>
                    </div>
                    @endcan
                    <!-- /.col -->
                    <!-- /input-group -->
                </div>
                <!-- /.box-body -->
            </div>


		</div>
	</div>
    {!! Form::close() !!}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Attenzione</strong> Ci sono problemi nei dati inseriti:<br/>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection

