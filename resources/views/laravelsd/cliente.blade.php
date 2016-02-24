{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('codice_fiscale', 'Codice_fiscale:') !!}
			{!! Form::text('codice_fiscale') !!}
		</li>
		<li>
			{!! Form::label('partita_iva', 'Partita_iva:') !!}
			{!! Form::text('partita_iva') !!}
		</li>
		<li>
			{!! Form::label('ragione_sociale', 'Ragione_sociale:') !!}
			{!! Form::text('ragione_sociale') !!}
		</li>
		<li>
			{!! Form::label('rating', 'Rating:') !!}
			{!! Form::text('rating') !!}
		</li>
		<li>
			{!! Form::label('cliente', 'Cliente:') !!}
			{!! Form::text('cliente') !!}
		</li>
		<li>
			{!! Form::label('settore', 'Settore:') !!}
			{!! Form::text('settore') !!}
		</li>
		<li>
			{!! Form::label('softwarehouse', 'Softwarehouse:') !!}
			{!! Form::text('softwarehouse') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}