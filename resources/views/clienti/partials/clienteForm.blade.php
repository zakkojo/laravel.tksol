<div class="box-body">
    <div class="form-group">
        <label>Ragione Sociale</label>
        {!! Form::text('ragione_sociale', null,['class'=>'form-control', 'id'=>'ragione_sociale', 'placeholder'=>'Ragione Sociale']) !!}
    </div>
    <div class="form-group">
        <label>Partita IVA</label>
        {!! Form::text('partita_iva', null,['class'=>'form-control', 'id'=>'partita_iva', 'placeholder'=>'Partita IVA']) !!}
    </div>
    <div class="form-group">
        <label>Codice Fiscale</label>
        {!! Form::text('codice_fiscale', null,['class'=>'form-control', 'id'=>'codice_fiscale', 'placeholder'=>'Codice Fiscale']) !!}
    </div>
    <div class="form-group">
        <label>Telefono</label>
        {!! Form::text('telefono', null,['class'=>'form-control', 'id'=>'telefono', 'placeholder'=>'Telefono']) !!}
    </div>
    <div class="form-group">
        <label>Fax</label>
        {!! Form::text('fax', null,['class'=>'form-control', 'id'=>'fax', 'placeholder'=>'FAX']) !!}
    </div>
    <div class="form-group">
        <label>Email</label>
        {!! Form::text('email', null,['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email']) !!}
    </div>
    <div class="form-group">
        <label>Indirizzo</label>
        {!! Form::text('indirizzo', null,['class'=>'form-control', 'id'=>'indirizzo', 'placeholder'=>'Indirizzo']) !!}
    </div>
    <div class="form-group">
        <label>Città</label>
        {!! Form::text('citta', null,['class'=>'form-control', 'id'=>'citta', 'placeholder'=>'Città']) !!}
    </div>
    <div class="form-group">
        <label>Provincia</label>
        {!! Form::text('provincia', null,['class'=>'form-control', 'id'=>'provincia', 'placeholder'=>'Provincia']) !!}
    </div>
    <div class="form-group">
        <label>CAP</label>
        {!! Form::text('cap', null,['class'=>'form-control', 'id'=>'cap', 'placeholder'=>'CAP']) !!}
    </div>
    <div class="form-group">
        <label>Distanza in Km</label>
        {!! Form::number('distanza', null,['class'=>'form-control', 'id'=>'distanza', 'placeholder'=>'Km']) !!}
    </div>
    <div class="form-group">
        <label>Settore Aziendale</label>
        {!! Form::text('settore', null,['class'=>'form-control', 'id'=>'settore', 'placeholder'=>'Settore Aziendale']) !!}
    </div>
    <div class="form-group">
        <label>Rating</label>
        {!! Form::number('rating', null,['class'=>'form-control', 'id'=>'rating', 'placeholder'=>'Rating']) !!}

    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <?php $cli_check = (isset($cliente)) ? ($cliente->cliente == '1') ? true : '' : true ?>
                    {!!  Form::checkbox('cliente', 'cliente', $cli_check) !!} Cliente
                </label>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    {!! Form::checkbox('softwarehouse', 'softwarehouse') !!} Softwarehouse
                </label>
            </div>
        </div><!-- /.col -->
    </div>

</div><!-- /.box-body -->

