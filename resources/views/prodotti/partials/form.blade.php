<div class="box-body">
    <div class="form-group">
        <label>Nome</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('nome', null,['class'=>'form-control  pull-right', 'id'=>'nome', 'placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <label>Codice</label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-money"></i>
            </div>
            {!! Form::text('codice', null,['class'=>'form-control  pull-right', 'id'=>'codice', 'placeholder'=>'']) !!}
        </div>
    </div>
</div><!-- /.box-body -->

<div class="box-footer">
    @if(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin')
        <button type="submit" class="btn btn-primary">Submit</button>
    @endif
</div>
