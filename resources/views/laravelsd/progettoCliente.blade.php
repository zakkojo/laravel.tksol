{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_cliente', 'Id_cliente:') !!}
			{!! Form::text('id_cliente') !!}
		</li>
		<li>
			{!! Form::label('id_progetto', 'Id_progetto:') !!}
			{!! Form::text('id_progetto') !!}
		</li>
		<li>
			{!! Form::label('stato', 'Stato:') !!}
			{!! Form::text('stato') !!}
		</li>
		<li>
			{!! Form::label('note', 'Note:') !!}
			{!! Form::text('note') !!}
		</li>
		<li>
			{!! Form::label('data_primo_contatto', 'Data_primo_contatto:') !!}
			{!! Form::text('data_primo_contatto') !!}
		</li>
		<li>
			{!! Form::label('data_avvio_progetto', 'Data_avvio_progetto:') !!}
			{!! Form::text('data_avvio_progetto') !!}
		</li>
		<li>
			{!! Form::label('data_chiusura_progetto', 'Data_chiusura_progetto:') !!}
			{!! Form::text('data_chiusura_progetto') !!}
		</li>
		<li>
			{!! Form::label('modalita_fattura', 'Modalita_fattura:') !!}
			{!! Form::text('modalita_fattura') !!}
		</li>
		<li>
			{!! Form::label('importo', 'Importo:') !!}
			{!! Form::text('importo') !!}
		</li>
		<li>
			{!! Form::label('data_validita_contratto', 'Data_validita_contratto:') !!}
			{!! Form::text('data_validita_contratto') !!}
		</li>
		<li>
			{!! Form::label('periodicita_pagamenti', 'Periodicita_pagamenti:') !!}
			{!! Form::text('periodicita_pagamenti') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}