<div class="box-body">
    @foreach($societas as $societa)
        <div class="form-group">
            <label>ID Gamma x {{$societa->nome}}</label>
            {!! Form::text('idGamma['.$societa->id.']',
            (($cs = collect($cliente_societa)->where('societa_id',(string)$societa->id)->first()) ? $cs->idGamma:null),
            ['class'=>'form-control', 'id'=>'idGamma_'.$societa->id, 'placeholder'=>'idGamma_'.$societa->id]) !!}
        </div>
    @endforeach
</div>