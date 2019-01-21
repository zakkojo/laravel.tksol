<div class="box-body">
    <div class="form-group">
        <label>Contatto</label>
        {!! Form::text('descrizione', null,['class'=>'form-control', 'id'=>'descrizione', 'placeholder'=>'Nome Cognome']) !!}
        {!! Form::text('ruolo', null,['class'=>'form-control', 'id'=>'ruolo', 'placeholder'=>'Note o Ruolo']) !!}
    </div>
    <div class="form-group">
        <label>Email</label>
        {!! Form::input('email','email', null,['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email']) !!}
        <input type="hidden" name="user_email" value="{{$contatto->userEmail or ''}}"/>
    </div>
    <div class="form-group">
        <label>Telefono/Fax</label>
        {!! Form::text('telefono', null,['class'=>'form-control', 'id'=>'telefono', 'placeholder'=>'Telefono']) !!}
        {!! Form::text('telefono2', null,['class'=>'form-control', 'id'=>'telefono2', 'placeholder'=>'Cellulare']) !!}
        {!! Form::text('fax', null,['class'=>'form-control', 'id'=>'fax', 'placeholder'=>'FAX']) !!}
    </div>
    <div class="form-group">
        <label>Indirizzo*</label>
        {!! Form::text('indirizzo', null,['class'=>'form-control', 'id'=>'indirizzo', 'placeholder'=>'Indirizzo']) !!}
        {!! Form::text('citta', null,['class'=>'form-control', 'id'=>'citta', 'placeholder'=>'Città']) !!}
        {!! Form::text('provincia', null,['class'=>'form-control', 'id'=>'provincia', 'placeholder'=>'Provincia']) !!}
        {!! Form::text('cap', null,['class'=>'form-control', 'id'=>'cap', 'placeholder'=>'CAP']) !!}
    </div>
</div><!-- /.box-body -->
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>