<div class="box-body">
    <div class="form-group">
        <label>Cliente</label>
        <select id="cliente_id" @if(! empty($_GET['cli'])) disabled @endif name="cliente_id"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value=""></option>
            @foreach($clienti as $cliente)
                @if((! empty($_GET['cli']) AND $_GET['cli'] == $cliente->id) OR $contratto->cliente_id ==$cliente->id )
                    <option selected value="{{$cliente->id}}">{{$cliente->ragione_sociale}}</option>
                @else

                    <option value="{{$cliente->id}}">{{$cliente->ragione_sociale}}</option>
                @endif
            @endforeach
        </select>
        @if(! empty($_GET['cli']))<input type="hidden" name="cliente_id" value="{{$_GET['cli']}}">@endif
    </div>
    <div class="form-group">
        <label>Progetto</label>
        <select id="progetto_id" @if(! empty($_GET['prog'])) disabled @endif name="progetto_id"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value=""></option>
            @foreach($progetti as $progetto)
                @if(! empty($_GET['prog']) AND $_GET['prog'] == $cliente->id)
                    <option selected value="{{$progetto->id}}">{{$progetto->area}} / {{$progetto->nome}}</option>
                @else
                    <option value="{{$progetto->id}}">{{$progetto->area}} / {{$progetto->nome}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Capo Progetto</label>
        <select id="consulente_id" @if(! empty($_GET['cons'])) disabled @endif name="consulente_id"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value=""></option>
            @foreach($consulenti as $consulente)
                @if(! empty($_GET['cons']) AND $_GET['cons'] == $consulente->id)
                    <option selected value="{{$consulente->id}}">{{$consulente->cognome}} {{$consulente->nome}}</option>
                @elseif( empty($_GET['cons']) AND Auth::user()->consulente->id == $consulente->id)
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
        <select id="modalita_fattura" name="modalita_fattura"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value="{{ $contratto->modalita_fattura or  '' }}"> {{ $contratto->modalita_fattura or  '' }}</option>
            <option value="CHIAVI_IN_MANO">Chiavi in Mano</option>
            <option value="TIME_CONSUMING">Time Consuming</option>
        </select>
    </div>
    <div class="form-group">
        <label>Periodicità pagamenti</label>
        <select id="periodicita_pagamenti" name="periodicita_pagamenti"
                class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                aria-hidden="true">
            <option value="{{ $contratto->periodicita_pagamenti or  '' }}"> {{ $contratto->periodicita_pagamenti or  '' }}</option>
            <option value="1">Mensile</option>
            <option value="3">Trimestrale</option>
            <option value="6">Semestrale</option>
            <option value="12">Annuale</option>
        </select>
    </div>

</div><!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
