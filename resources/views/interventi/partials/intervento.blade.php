<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Intervento</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form role="form">

            <div class="form-group">
                <label>Stato</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                        aria-hidden="true">
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
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                        aria-hidden="true">
                    <option selected="selected">Intervento on site</option>
                    <option>Intervento remoto</option>
                    <option>Telefonata</option>
                    <option>...</option>
                </select>
                <label>Fatturabile</label>
                <label>
                    <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false"
                         style="position: relative;"><input type="checkbox" class="flat-red"
                                                            style="position: absolute; opacity: 0;">
                        <ins class="iCheck-helper"
                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                    </div>
                </label>

            </div>

        </form>
    </div>
</div>