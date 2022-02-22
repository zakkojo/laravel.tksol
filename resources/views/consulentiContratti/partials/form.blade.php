<?php
$listConsulenti = $consulenti->pluck('nominativo', 'id');
$contratto_id = (isset($consulenteContratto)) ? $consulenteContratto->contratto_id : $contratto->id;
?>
<div class="box-body">
    <input type="hidden" name="contratto_id"
           value= {{(isset($consulenteContratto)) ? $consulenteContratto->contratto_id : $contratto->id}}>
    <div class="form-group">
        <label>Consulente</label>
        {!! Form::select('consulente_id',
        $listConsulenti,
        (isset($consulenteContratto)) ? $consulenteContratto->consulente_id : '',
        ['id'=>'consulente_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Ruolo</label>
        <div class="input-group">
            {!! Form::select('ruolo',
            array('Consulente' => 'Consulente', 'Capo Progetto'=>'Capo Progetto'),
            (isset($consulenteContratto)) ? $consulenteContratto->ruolo : '',
            ['id'=>'ruolo','style'=>'width:100%', 'class'=>'form-control'])
        !!}
        </div>
    </div>
    <div class="form-group">
        <label>Note</label>
        <div id="note" name="note" class="wysihtml5"
             style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; "
             placeholder="">
            {{ $consulenteContratto->note or '' }}
        </div>
    </div>
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin' OR Auth::User()->consulente->contratti->contains($contratto_id))
        <button type="submit" class="btn btn-primary">Salva</button>
    @endif
</div>
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
        });
    </script>
@append