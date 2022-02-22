{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_intervento', 'Id_intervento:') !!}
			{!! Form::text('id_intervento') !!}
		</li>
		<li>
			{!! Form::label('id_consulente', 'Id_consulente:') !!}
			{!! Form::text('id_consulente') !!}
		</li>
		<li>
			{!! Form::label('fatturabile', 'Fatturabile:') !!}
			{!! Form::text('fatturabile') !!}
		</li>
		<li>
			{!! Form::label('importo', 'Importo:') !!}
			{!! Form::text('importo') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}