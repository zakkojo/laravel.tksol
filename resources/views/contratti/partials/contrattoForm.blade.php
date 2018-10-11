<?php
if (isset($contratto)) $soc = $contratto->societa_id;
elseif (isset($_GET['soc'])) $soc = $_GET['soc'];
else $soc = 0;
if ($soc) $socDisabled = 'disabled';
else $socDisabled = 'enabled';
$listSocieta = $societa->pluck('nome', 'id');

if (isset($contratto)) $cli = $contratto->cliente_id;
elseif (isset($_GET['cli'])) $cli = $_GET['cli'];
else $cli = 0;
if ($cli) $cliDisabled = 'disabled';
else $cliDisabled = 'enabled';
$listClienti = $clienti->pluck('ragione_sociale', 'id');

if (isset($contratto))
{
    $swhDisabled = 'disabled';
    $swh = $contratto->fatturazione_id;
    if ($swh == $contratto->cliente_id)
        $softwarehouse->push(['id' => $swh, 'ragione_sociale' => 'Cliente']);
} else
{
    $swhDisabled = 'enabled';
    $swh = 0;
    $softwarehouse->push(['id' => '0', 'ragione_sociale' => 'Cliente']);
}
$softwarehouse = $softwarehouse->sortBy('id');
$listSW = $softwarehouse->pluck('ragione_sociale', 'id');


if (isset($contratto)) $prog = $contratto->progetto_id;
elseif (isset($_GET['prog'])) $prog = $_GET['prog'];
else $prog = 0;
if ($prog) $progDisabled = 'disabled';
else $progDisabled = 'enabled';
$listProgetto = $progetti->each(function ($progetto)
{
    return $progetto['areanome'] = $progetto['area'] . ' / ' . $progetto['nome'];
})->pluck('areanome', 'id');

if (isset($contratto))
{
    $periodo = $contratto->periodicita_pagamenti;
    $modalita = $contratto->modalita_fattura;
    $rimborsi = $contratto->rimborsi;
    $stato = $contratto->stato;
} else
{
    $periodo = '';
    $modalita = '';
    $rimborsi = 'nessuno';
    $stato = '';
}
?>
<div class="box-body">
    <div class="form-group">
        <label>Società</label>
        {!! Form::select('societa_id',
            $listSocieta,
            $soc,
            ['enabled' => 'enabled','id'=>'societa_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Cliente</label>
        {!! Form::select('cliente_id',
            $listClienti,
            $cli,
            [$cliDisabled => $cliDisabled,'id'=>'cliente_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
        @if($cli)<input type="hidden" name="cliente_id" value="{{$cli}}">@endif
    </div>
    <div class="form-group">
        <label>Progetto</label>
        {!! Form::select('progetto_id',
            $listProgetto,
            $prog,
            [$progDisabled => $progDisabled,'id'=>'progetto_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
        @if($prog)<input type="hidden" name="progetto_id" value="{{$prog}}">@endif
    </div>
    <div class="form-group">
        <label>Fatturazione</label>
        {!! Form::select('fatturazione_id',
            $listSW,
            $swh,
            [$swhDisabled => $swhDisabled,'id'=>'fatturazione_id','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    @if($swh)<input type="hidden" name="fatturazione_id" value="{{$swh}}">@endif
    <div class="form-group">
        <label>Stato Contratto</label>
        {!! Form::select('stato',
            array('PROSPECT' => 'Prospect','FALL' => 'FALL','ACTIVE' => 'Attivo','CLOSED' => 'Chiuso'),
            $stato,
            ['id'=>'stato','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
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
        <label>Modalità Fatturazione</label>
        {!! Form::select('modalita_fattura',
            array('CHIAVI_IN_MANO' => 'Chiavi in Mano','TIME_CONSUMING' => 'Time Consuming'),
            $modalita,
            ['id'=>'modalita_fattura','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
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
        <label>Periodicità pagamenti</label>
        {!! Form::select('periodicita_pagamenti',
            array(''=>'','1' => 'Mensile','3' => 'Trimestrale','6' => 'Semestrale','12' => 'Annuale'),
            $periodo,
            ['id'=>'periodicita_pagamenti','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>
    <div class="form-group">
        <label>Rimborsi</label>
        {!! Form::select('rimborsi',
            array('piedilista' => 'Piè di Lista','forfait' => 'Forfait','nessuno' => 'Non Previsti'),
            $rimborsi,
            ['id'=>'rimborsi','style'=>'width:100%', 'class'=>'form-control select2 select2-hidden-accessible'])
        !!}
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="checkbox icheck">
                <label>
                    <?php
                    if (isset($contratto))
                    {
                        if ($contratto->ripianifica == '1') $ripianifica_check = true;
                        else $ripianifica_check = '';
                    } else $ripianifica_check = true
                    ?>
                    {!!  Form::checkbox('ripianifica', 'ripianifice', $ripianifica_check) !!} Obbligo Ripianificare
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-6">
            <div class="checkbox icheck">
                <label>
                    <?php
                    if (isset($contratto))
                    {
                        if ($contratto->fatturazione_default == '1') $fatturazione_default_check = true;
                        else $fatturazione_default_check = '';
                    } else $fatturazione_default_check = true
                    ?>
                    {!!  Form::checkbox('fatturazione_default', 'fatturazione_default', $fatturazione_default_check) !!} Default Fatturazione
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <?php
                    if (isset($contratto))
                    {
                        if ($contratto->rapportino == '1') $rapportino_check = true;
                        else $rapportino_check = false;
                    } else $rapportino_check = true
                    ?>
                    {!! Form::checkbox('rapportino', 'rapportino',$rapportino_check) !!} Obbligo Invio Rapportino
                </label>
            </div>
        </div><!-- /.col -->
    </div>
</div><!-- /.box-body -->

<div class="box-footer">
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif
</div>
@section('page_scripts')
    <script>
        $('document').ready(function () {
            $('#modalita_fattura').trigger('change');
        });

        $('#modalita_fattura').change(function () {
            if ($('#modalita_fattura').val() != 'CHIAVI_IN_MANO') {
                $('#importo').val('0');
                $('#importo').prop('readonly', true);
            }
            else $('#importo').prop('readonly', false);
        });
    </script>
@append
