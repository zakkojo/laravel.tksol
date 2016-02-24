{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('area', 'Area:') !!}
			{!! Form::text('area') !!}
		</li>
		<li>
			{!! Form::label('nome', 'Nome:') !!}
			{!! Form::text('nome') !!}
		</li>
		<li>
			{!! Form::label('id_progetto', 'Id_progetto:') !!}
			{!! Form::text('id_progetto') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}