@extends('layouts.app')


@section('htmlheader_title')
   Nuovo Intervento
@endsection
@section('contentheader_title')
    Rapportino
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
           <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
           </ul>
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Cliente e Attività</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form">

                <div class="form-group">
                    <label>Cliente</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Cliente 1</option>
                        <option>Cliente 2</option>
                        <option>Cliente 3</option>
                        <option>...</option>
                    </select>
                    <label>Contratto / Progetto</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Contratto A - DocFinance</option>
                        <option>Contratto B - QLIK</option>
                        <option>Contratto C - altro</option>
                        <option>...</option>
                    </select>
                    <label>Attività</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">1. Avvio</option>
                        <option>1.1. Installazione</option>
                        <option>1.2. Configurazione</option>
                        <option>...</option>
                    </select>
                </div>

            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Consulente</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <label>Consulente</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Roberto Spaccini</option>
                        <option>Gianni Graffiedi</option>
                        <option>...</option>
                    </select>
                    <label>Tipo</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Senior</option>
                        <option>Junior</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Rimborsi</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <label>Tipo spesa</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Viaggio</option>
                        <option>Vitto</option>
                        <option>...</option>
                    </select>
                    <label>UM</label>
                    <input type="text" class="form-control" data-inputmask="" data-mask="">
                    <label>Qtà</label>
                    <input type="text" class="form-control" data-inputmask="" data-mask="">
                    <label>Importo</label>
                    <input type="text" class="form-control" data-inputmask="" data-mask="">
                </div>
            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Intervento</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form">

                <div class="form-group">
                    <label>Stato</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Da pianificare</option>
                        <option>Pianificato</option>
                        <option>Completato</option>
                    </select>
                    <label>Data</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                    </div>
                    <!-- /.input group -->
                    <label>Tipo</label>
                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected">Intervento on site</option>
                        <option>Intervento remoto</option>
                        <option>Telefonata</option>
                        <option>...</option>
                    </select>
                    <label>Fatturabile</label>
                    <label>
                        <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" class="flat-red" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                    </label>

                </div>

            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attività Svolte</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attività Pianificate</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attività in carico al cliente</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </form>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Problemi aperti</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form role="form">
                <div class="form-group">
                    <textarea></textarea>
                </div>
            </form>
        </div>
    </div>
@endsection