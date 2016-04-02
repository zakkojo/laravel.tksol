<?php
if (isset($contrattoIntervento))
{
    $tipo_iva = $contrattoIntervento->tipo_iva;
} else
{
    $tipo_iva = '';
}
?>
<div class="box-body">
    <input type="hidden" name="contratto_id" value = {{$contratto->id}}>
    <div class="form-group">
        <label>Descrizione</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-pencil"></i>
            </div>
            {!! Form::text('descrizione', null,['class'=>'form-control  pull-right', 'id'=>'descrizione', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Tariffa Oraria</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('tariffa_ora', null,['class'=>'form-control  pull-right', 'id'=>'tariffa_ora', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>IVA</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="glyphicon"><b> % </b></i>
            </div>
            {!! Form::text('iva', null,['class'=>'form-control  pull-right', 'id'=>'iva', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Tipo IVA</label>
        {!! Form::select('tipo_iva',
            array('NORMALE' => 'Normale','SPLIT-' => 'Split'),
            $tipo_iva,
            ['id'=>'tipo_iva','style'=>'width:100%', 'class'=>'form-control'])
        !!}
    </div>
    <div class="form-group">
        <label>Ore Previste*</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            {!! Form::text('ore_previste', null,['class'=>'form-control  pull-right', 'id'=>'ore_previste', 'placeholder'=>'']) !!}
        </div>
    </div>
</div><!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
