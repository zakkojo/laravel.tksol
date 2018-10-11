<div class="box-body">
    <input type="hidden" name="intervento_id" value="{{$intervento->id}}">
    <div class="form-group">
        <label>Tipo spesa</label>
        <select id="tipo_spesa" name="tipo_spesa" class="form-control" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option selected="selected">{{ $rimborso->tipo_spesa or ''}}</option>
            <option>Viaggio</option>
            <option>Pasto</option>
            <option>Altro</option>
        </select>
    </div>
    <div class="form-group">
        <label>UM</label>
        <div class="input-group">
            {!! Form::text('um', null,['class'=>'form-control  ', 'id'=>'um', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Quantità</label>
        <div class="input-group">
            {!! Form::text('quantita', null,['class'=>'form-control  pull-right', 'id'=>'quantita', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Importo</label>
        <div class="input-group">
            {!! Form::text('importo', null,['class'=>'form-control  pull-right', 'id'=>'importo', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Note</label>
        <div id="note" name="note" class="wysihtml5"
             style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
             placeholder="">
            {{ $rimborso->note or '' }}
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Salva</button>
</div>
<div id="distanza" class="hidden">{{$intervento->listinoInterventi->contratto->cliente->distanza}}</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
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

            $('#tipo_spesa').change(function () {
                if($('#tipo_spesa').val() == 'Viaggio') {
                    $('#um').val('Km');
                    $('#quantita').val($('#distanza').text());
                }
                else {
                    $('#um').val('');
                    $('#quantita').val('');
                }
            });
        });
    </script>
@append