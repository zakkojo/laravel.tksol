{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('codice', 'Codice:') !!}
			{!! Form::text('codice') !!}
		</li>
		<li>
			{!! Form::label('tipo_codice', 'Tipo_codice:') !!}
			{!! Form::text('tipo_codice') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}