{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_cliente', 'Id_cliente:') !!}
			{!! Form::text('id_cliente') !!}
		</li>
		<li>
			{!! Form::label('descrizione', 'Descrizione:') !!}
			{!! Form::text('descrizione') !!}
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
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('email2', 'Email2:') !!}
			{!! Form::text('email2') !!}
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
			{!! Form::label('provincia', 'Provincia:') !!}
			{!! Form::text('provincia') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}