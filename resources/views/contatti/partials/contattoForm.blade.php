<div class="box-body">
    <div class="form-group">
        {!! Form::text('descrizione', null,['class'=>'form-control', 'id'=>'descrizione', 'placeholder'=>'Cognome Nome']) !!}
    </div>
    <div class="form-group">
        {!! Form::input('email','email', null,['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email']) !!}
        {!! Form::input('email','email2', null,['class'=>'form-control', 'id'=>'email2', 'placeholder'=>'Email secondaria']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('indirizzo', null,['class'=>'form-control', 'id'=>'indirizzo', 'placeholder'=>'Indirizzo']) !!}
        {!! Form::text('citta', null,['class'=>'form-control', 'id'=>'citta', 'placeholder'=>'Città']) !!}
        {!! Form::text('provincia', null,['class'=>'form-control', 'id'=>'provincia', 'placeholder'=>'Provincia']) !!}
        {!! Form::text('cap', null,['class'=>'form-control', 'id'=>'cap', 'placeholder'=>'CAP']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('telefono', null,['class'=>'form-control', 'id'=>'telefono', 'placeholder'=>'Telefono']) !!}
        {!! Form::text('telefono2', null,['class'=>'form-control', 'id'=>'telefono2', 'placeholder'=>'2° telefono']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('mobile', null,['class'=>'form-control', 'id'=>'mobile', 'placeholder'=>'Mobile']) !!}
        {!! Form::text('mobile2', null,['class'=>'form-control', 'id'=>'mobile2', 'placeholder'=>'2°mobile']) !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>