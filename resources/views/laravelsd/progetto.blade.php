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
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}