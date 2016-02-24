{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('id_progetto', 'Id_progetto:') !!}
			{!! Form::text('id_progetto') !!}
		</li>
		<li>
			{!! Form::label('sequenza', 'Sequenza:') !!}
			{!! Form::text('sequenza') !!}
		</li>
		<li>
			{!! Form::label('descrizione', 'Descrizione:') !!}
			{!! Form::text('descrizione') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}