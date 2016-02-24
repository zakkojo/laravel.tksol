{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('tipo_spesa', 'Tipo_spesa:') !!}
			{!! Form::text('tipo_spesa') !!}
		</li>
		<li>
			{!! Form::label('um', 'Um:') !!}
			{!! Form::text('um') !!}
		</li>
		<li>
			{!! Form::label('quantita', 'Quantita:') !!}
			{!! Form::text('quantita') !!}
		</li>
		<li>
			{!! Form::label('importo', 'Importo:') !!}
			{!! Form::text('importo') !!}
		</li>
		<li>
			{!! Form::label('note', 'Note:') !!}
			{!! Form::text('note') !!}
		</li>
		<li>
			{!! Form::label('id_intervento', 'Id_intervento:') !!}
			{!! Form::text('id_intervento') !!}
		</li>
		<li>
			{!! Form::label('id_consulente', 'Id_consulente:') !!}
			{!! Form::text('id_consulente') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}