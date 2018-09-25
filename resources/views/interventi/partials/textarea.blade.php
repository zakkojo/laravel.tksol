<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attività Pianificate</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
                <div class="form-group">
                    <textarea class="wysihtml5" id="textAreaAttivitaPianificate"name="attivitaPianificate" @if($intervento->inviato) disabled @endif
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder="">{!! htmlspecialchars_decode($intervento->attivitaPianificate) !!}</textarea>
                </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Attività Svolte</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
                <div class="form-group">
                    <textarea class="wysihtml5" id="textAreaAttivitaSvolte" name="attivitaSvolte" @if($intervento->inviato) disabled @endif
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder="">{!! htmlspecialchars_decode($intervento->attivitaSvolte) !!}</textarea>
                </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Note</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
                <div class="form-group">
                    <textarea class="wysihtml5" name="attivitaCaricoCliente" @if($intervento->inviato) disabled @endif
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder="">{!! htmlspecialchars_decode($intervento->attivitaCaricoCliente) !!}</textarea>
                </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">Prossime Attività</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
                <div class="form-group">
                    <textarea class="wysihtml5" name="problemiAperti" @if($intervento->inviato) disabled @endif
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder="">{!! htmlspecialchars_decode($intervento->problemiAperti) !!}</textarea>
                </div>
        </div>
    </div>
</div>
@section('page_scripts')
    @parent
    <script>
        $(document).ready(function () {
            $('.wysihtml5').wysihtml5({
                toolbar: {
                    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                    "emphasis": true, //Italics, bold, etc. Default true
                    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                    "html": false, //Button which allows you to edit the generated HTML. Default false
                    "link": false, //Button to insert a link. Default true
                    "image": false, //Button to insert an image. Default true,
                    "color": false, //Button to change color of font
                    "blockquote": false, //Blockquote
                    "size": 'sm' //default: none, other options are xs, sm, lg
                }
            });
            if($($('#textAreaAttivitaSvolte').val()).text().length <= 1) {
                $('#textAreaAttivitaSvolte').val($('#textAreaAttivitaPianificate').val());
            }
        });
        $(document).on('submit', 'form.riepilogoForm', function (e) {
            if($($('#textAreaAttivitaSvolte').val()).text().length <= 100) {
                if (confirm('Attività Svolte non sembra compilato correttamente vuoi aggiornare comunque l\'intervento?'))
                {}
                else
                    e.preventDefault();
            }
        });
    </script>
@append
