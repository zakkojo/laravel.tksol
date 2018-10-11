<?php
$listClienti = $softwarehouse->lists('ragione_sociale', 'id');
$listProdotti = $prodotti->lists('nome', 'id');

if (isset($listinoProdotto))
{
    $tipo_iva = $listinoProdotto->tipo_iva;
} else
{
    $tipo_iva = '';
}
?>
<div class="box-body">
    <input type="hidden" name="contratto_id" value= {{$contratto->id}}>
    <div class="form-group">
        <label>Prodotto</label>
        {!! Form::select('prodotto_id',
            $listProdotti,
            null,
            ['id'=>'prodotto_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Importo</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('importo', null,['class'=>'form-control  pull-right', 'id'=>'importo', 'placeholder'=>'']) !!}
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
            array('NORMALE' => 'Normale','SPLIT' => 'Split'),
            $tipo_iva,
            ['id'=>'tipo_iva','style'=>'width:100%', 'class'=>'form-control'])
        !!}
    </div>
    <div class="form-group">
        <label>Softwarehouse</label>
        {!! Form::select('softwarehouse_id',
            $listClienti,
            null,
            ['id'=>'softwarehouse_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Fee</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            {!! Form::text('ore_previste', null,['class'=>'form-control  pull-right', 'id'=>'ore_previste', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Tipo Vendita</label>
        {!! Form::select('tipo_vendita',
            array('LICENZA' => 'Licenza','NOLEGGIO' => 'Noleggio'),
            $tipo_iva,
            ['id'=>'tipo_vendita','style'=>'width:100%', 'class'=>'form-control'])
        !!}
    </div>
    <div class="form-group">
        <label>Data scadenza licenza/noleggio</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {!! Form::text('scadenza', null,['class'=>'datepicker form-control  pull-right', 'id'=>'scadenza', 'placeholder'=>'gg/mm/aaaa']) !!}
        </div>
    </div>
</div><!-- /.box-body -->

<div class="box-footer">
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif
</div>
