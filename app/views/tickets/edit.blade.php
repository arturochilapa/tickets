@extends ('tickets.common')
@section ('titulo') Editando {{$ticket->no_ticket}}  @stop
@section ('content')
{{ HTML::ul($errors->all()) }}
{{ Form::model($ticket, array('route' => array('update', $ticket->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop
