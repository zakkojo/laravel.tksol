{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('codice_fiscale', 'Codice_fiscale:') !!}
			{!! Form::text('codice_fiscale') !!}
		</li>
		<li>
			{!! Form::label('cognome', 'Cognome:') !!}
			{!! Form::text('cognome') !!}
		</li>
		<li>
			{!! Form::label('nome', 'Nome:') !!}
			{!! Form::text('nome') !!}
		</li>
		<li>
			{!! Form::label('indirizzo', 'Indirizzo:') !!}
			{!! Form::text('indirizzo') !!}
		</li>
		<li>
			{!! Form::label('citta', 'Citta:') !!}
			{!! Form::text('citta') !!}
		</li>
		<li>
			{!! Form::label('cap', 'Cap:') !!}
			{!! Form::text('cap') !!}
		</li>
		<li>
			{!! Form::label('telefono', 'Telefono:') !!}
			{!! Form::text('telefono') !!}
		</li>
		<li>
			{!! Form::label('telefono2', 'Telefono2:') !!}
			{!! Form::text('telefono2') !!}
		</li>
		<li>
			{!! Form::label('mobile', 'Mobile:') !!}
			{!! Form::text('mobile') !!}
		</li>
		<li>
			{!! Form::label('mobile2', 'Mobile2:') !!}
			{!! Form::text('mobile2') !!}
		</li>
		<li>
			{!! Form::label('partita_iva', 'Partita_iva:') !!}
			{!! Form::text('partita_iva') !!}
		</li>
		<li>
			{!! Form::label('tipo', 'Tipo:') !!}
			{!! Form::text('tipo') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}