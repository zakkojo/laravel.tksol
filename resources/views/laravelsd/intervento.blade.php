{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('stato', 'Stato:') !!}
			{!! Form::text('stato') !!}
		</li>
		<li>
			{!! Form::label('data_intervento', 'Data_intervento:') !!}
			{!! Form::text('data_intervento') !!}
		</li>
		<li>
			{!! Form::label('fatturabile', 'Fatturabile:') !!}
			{!! Form::text('fatturabile') !!}
		</li>
		<li>
			{!! Form::label('relazione', 'Relazione:') !!}
			{!! Form::textarea('relazione') !!}
		</li>
		<li>
			{!! Form::label('note', 'Note:') !!}
			{!! Form::textarea('note') !!}
		</li>
		<li>
			{!! Form::label('id_cliente', 'Id_cliente:') !!}
			{!! Form::text('id_cliente') !!}
		</li>
		<li>
			{!! Form::label('id_progetto', 'Id_progetto:') !!}
			{!! Form::text('id_progetto') !!}
		</li>
		<li>
			{!! Form::label('id_attivita', 'Id_attivita:') !!}
			{!! Form::text('id_attivita') !!}
		</li>
		<li>
			{!! Form::label('id_tipo_intervento', 'Id_tipo_intervento:') !!}
			{!! Form::text('id_tipo_intervento') !!}
		</li>
		<li>
			{!! Form::label('tipo_consulente', 'Tipo_consulente:') !!}
			{!! Form::text('tipo_consulente') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}