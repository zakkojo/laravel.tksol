@if (count($errors) > 0)
    <div class="callout callout-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Rimborsi</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form role="form">
            <div class="form-group">
                <label>Tipo spesa</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                        aria-hidden="true">
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>