<?php
if (isset($contratto)) $cli = $contratto->cliente_id;
elseif (isset($_GET['cli'])) $cli = $_GET['cli'];
else $cli = 0;

if (isset($contratto)) $prog = $contratto->progetto_id;
elseif (isset($_GET['prog'])) $prog = $_GET['prog'];
else $prog = 0;

if (isset($contratto)) $cons = $contratto->capo_progetto;
elseif (isset($_GET['cons'])) $cons = $_GET['cons'];
else $cons = 0;
if (isset($contratto))
{
    $periodo = $contratto->periodicita_pagamenti;
    $modalita = $contratto->modalita_fattura;
} else
{
    $periodo = '';
    $modalita = '';
}
?>
<div class="box-body">
    <div class="form-group">
        <label>Cliente</label>
        <select id="cliente_id" @if($cli) disabled @endif name="cliente_id"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value=""></option>
            @foreach($clienti as $cliente)
                @if($cli == $cliente->id )
                    <option selected value="{{$cliente->id}}">{{$cliente->ragione_sociale}}</option>
                @else
                    <option value="{{$cliente->id}}">{{$cliente->ragione_sociale}}</option>
                @endif
            @endforeach
        </select>
        @if($cli)<input type="hidden" name="cliente_id" value="{{$cli}}">@endif
    </div>
    <div class="form-group">
        <label>Progetto</label>
        <select id="progetto_id" @if($prog) disabled @endif name="progetto_id"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value=""></option>
            @foreach($progetti as $progetto)
                @if($prog == $progetto->id)
                    <option selected value="{{$progetto->id}}">{{$progetto->area}} / {{$progetto->nome}}</option>
                @else
                    <option value="{{$progetto->id}}">{{$progetto->area}} / {{$progetto->nome}}</option>
                @endif
            @endforeach
        </select>
        @if($prog)<input type="hidden" name="progetto_id" value="{{$prog}}">@endif
    </div>
    <div class="form-group">
        <label>Capo Progetto</label>
        <select id="capo_progetto" name="capo_progetto" class="form-control select2 select2-hidden-accessible"
                style="width: 100%;" tabindex="-1" aria-hidden="true">
            <option value=""></option>
            @foreach($consulenti as $consulente)
                @if($cons == $consulente->id)
                    <option selected value="{{$consulente->id}}">{{$consulente->cognome}} {{$consulente->nome}}</option>
                @elseif( $cons = 0 AND Auth::user()->consulente->id == $consulente->id)
                    <option selected value="{{$consulente->id}}">{{$consulente->cognome}} {{$consulente->nome}}</option>
                @else
                    <option value="{{$consulente->id}}">{{$consulente->cognome}} {{$consulente->nome}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Stato Contratto</label>
        <select id="stato" @if(! empty($_GET['cons'])) disabled @endif name="stato"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option @if(! empty($contratto->stato)) selected @endif value="CONTACT">Contact</option>
            <option value="PROSPECT">Prospect</option>
            <option value="FALL">Fall</option>
            <option value="ACTIVE">Attivo</option>
            <option value="CLOSED">Chiuso</option>
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>data_primo_contatto</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('data_primo_contatto', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_primo_contatto', 'placeholder'=>'gg/mm/aaaa']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>data_validita_contratto</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('data_validita_contratto', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_validita_contratto', 'placeholder'=>'gg/mm/aaaa']) !!}
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>data_avvio_progetto</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('data_avvio_progetto', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_avvio_progetto', 'placeholder'=>'gg/mm/aaaa']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>data_chiusura_progetto</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('data_chiusura_progetto', null,['class'=>'datepicker form-control  pull-right', 'id'=>'data_chiusura_progetto', 'placeholder'=>'gg/mm/aaaa']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Importo</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('importo', null,['class'=>'form-control  pull-right', 'id'=>'importo', 'placeholder'=>'1000000']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Modalità Fatturazione</label>
        {!! Form::select('modalita_fattura',
            array(''=>'','CHIAVI_IN_MANO' => 'Chiavi in Mano','TIME_CONSUMING' => 'Time Consuming'),
            $modalita,
            ['id'=>'modalita_fattura','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Periodicità pagamenti</label>
        {!! Form::select('periodicita_pagamenti',
            array(''=>'','1' => 'Mensile','3' => 'Trimestrale','6' => 'Semestrale','12' => 'Annuale'),
            $periodo,
            ['id'=>'periodicita_pagamenti','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>

</div><!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
