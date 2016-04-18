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
        <form role="form">
            <div class="form-group">
                    <textarea class="wysihtml5"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder=""></textarea>
            </div>
        </form>
    </div>
</div>
</div>
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
        <form role="form">
            <div class="form-group">
                    <textarea class="wysihtml5"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder=""></textarea>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-6">
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">Attività in carico al cliente</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form role="form">
            <div class="form-group">
                    <textarea class="wysihtml5"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder=""></textarea>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-6">
<div class="box box-primary collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">Problemi aperti</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form role="form">
            <div class="form-group">
                    <textarea class="wysihtml5"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
                              placeholder=""></textarea>
            </div>
        </form>
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
        });
    </script>
@endsection