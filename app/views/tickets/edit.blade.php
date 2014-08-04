@extends ('tickets.common')
@section ('titulo') Editando {{$ticket->no_ticket}}  @stop
@section ('content')
{{ HTML::ul($errors->all()) }}
    {{ Form::model($ticket, array(
                            'route' => array(
                                'sistema.update', $ticket->id_ticket), 
                            'method' => 'PUT')) }}
        <div class="form-group">
      		{{ Form::label('tiendas', 'Tienda') }}
      		{{ Form::select('tienda', $combo, $ticket->id_tienda, array('class' => 'form-control')) }}
       	</div>
        <div class="form-group">
    		{{ Form::label('nombre', 'Nombre') }}
    		{{ Form::text('nombre', null, array('class' => 'form-control')) }}
    	</div>
    
    	<div class="form-group">
    		{{ Form::label('paterno', 'Apellido Paterno') }}
    		{{ Form::text('apellido_paterno', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('materno', 'Apellido Materno') }}
    		{{ Form::text('apellido_materno', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('fecha', 'Fecha') }}
    		{{ Form::text('fecha', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('edad', 'Edad') }}
    		{{ Form::text('edad', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('telefono', 'Tel&eacute;fono') }}
    		{{ Form::text('telefono', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('ticket', 'No Ticket') }}
    		{{ Form::text('no_ticket', null, array('class' => 'form-control')) }}
    	</div>
        <div class="form-group">
    		{{ Form::label('mail', 'Mail') }}
    		{{ Form::text('mail', null, array('class' => 'form-control')) }}
    	</div>

	{{ Form::submit('Actualizar Ticket', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
    <script>
        $(function() {
        $( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
      });
    </script>
@stop
