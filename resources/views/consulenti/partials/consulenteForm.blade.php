<div class="box-body">
    <div class="form-group">
        {!! Form::text('codice_fiscale', null,['class'=>'form-control', 'id'=>'codice_fiscale', 'placeholder'=>'Codice fiscale']) !!}
    </div>
    <div class="form-group">
        {!! Form::text('cognome', null,['class'=>'form-control', 'id'=>'cognome', 'placeholder'=>'Cognome']) !!}
        {!! Form::text('nome', null,['class'=>'form-control', 'id'=>'nome', 'placeholder'=>'Nome']) !!}
    </div>
    <div class="form-group">
        {!! Form::email('email', null,['class'=>'form-control', 'id'=>'email', 'placeholder'=>'email']) !!}
        <input type="hidden" name="user_email" value="{{$consulente->email or ''}}"/>
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
    <div class="form-group">
        {!! Form::text('partita_iva', null,['class'=>'form-control', 'id'=>'partita_iva', 'placeholder'=>'Partita IVA']) !!}
    </div>
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
        <div class="form-group">

            <select class="form-control select2 select2-hidden-accessible" name="tipo" style="width: 100%;"
                    tabindex="-1" aria-hidden="true">
                <option value="{{ $consulente->tipo or  '' }}"> {{ $consulente->tipo or  'Tipo' }}</option>
                <option value="Partner">Partner</option>
                <option value="Senior">Senior</option>
                <option value="Junior">Junior</option>
            </select>
        </div>
    @endif
</div><!-- /.box-body -->

<div class="box-footer">
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin' OR Auth::User()->consulente->id == $consulente->id)
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif
</div>