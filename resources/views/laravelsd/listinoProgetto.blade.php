{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_consulente', 'Id_consulente:') !!}
			{!! Form::text('id_consulente') !!}
		</li>
		<li>
			{!! Form::label('id_prodotto', 'Id_prodotto:') !!}
			{!! Form::text('id_prodotto') !!}
		</li>
		<li>
			{!! Form::label('importo', 'Importo:') !!}
			{!! Form::text('importo') !!}
		</li>
		<li>
			{!! Form::label('iva', 'Iva:') !!}
			{!! Form::text('iva') !!}
		</li>
		<li>
			{!! Form::label('tipo_iva', 'Tipo_iva:') !!}
			{!! Form::text('tipo_iva') !!}
		</li>
		<li>
			{!! Form::label('rimborsi', 'Rimborsi:') !!}
			{!! Form::text('rimborsi') !!}
		</li>
		<li>
			{!! Form::label('fee', 'Fee:') !!}
			{!! Form::text('fee') !!}
		</li>
		<li>
			{!! Form::label('id_sowftwarehouse', 'Id_sowftwarehouse:') !!}
			{!! Form::text('id_sowftwarehouse') !!}
		</li>
		<li>
			{!! Form::label('tipo_vendita', 'Tipo_vendita:') !!}
			{!! Form::text('tipo_vendita') !!}
		</li>
		<li>
			{!! Form::label('scadenza', 'Scadenza:') !!}
			{!! Form::text('scadenza') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}