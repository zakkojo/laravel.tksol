<div class="box-body">
    <div class="form-group">
        {!! Form::textarea('note', null,['class'=>'form-control', 'id'=>'note']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('partita_iva', null,['class'=>'form-control', 'id'=>'partita_iva', 'placeholder'=>'Partita IVA']) !!}
        {!! Form::text('codice_fiscale', null,['class'=>'form-control', 'id'=>'codice_fiscale', 'placeholder'=>'Codice Fiscale']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('telefono', null,['class'=>'form-control', 'id'=>'telefono', 'placeholder'=>'Telefono Principale']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('indirizzo', null,['class'=>'form-control', 'id'=>'indirizzo', 'placeholder'=>'Indirizzo']) !!}
        {!! Form::text('citta', null,['class'=>'form-control', 'id'=>'citta', 'placeholder'=>'Città']) !!}
        {!! Form::text('provincia', null,['class'=>'form-control', 'id'=>'provincia', 'placeholder'=>'Provincia']) !!}
        {!! Form::text('cap', null,['class'=>'form-control', 'id'=>'cap', 'placeholder'=>'CAP']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('settore', null,['class'=>'form-control', 'id'=>'settore', 'placeholder'=>'Settore Aziendale']) !!}
        {!! Form::text('rating', null,['class'=>'form-control', 'id'=>'rating', 'placeholder'=>'Rating']) !!}

    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    {!!  Form::checkbox('cliente', 'cliente') !!} Cliente
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

</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>