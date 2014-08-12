@extends ('tickets.common')
@section('titulo')Nuevo Ticket @stop
@section('content')
        @if(Session::has('message'))
             <div style="background-color: #DFF2BF;color: #4F8A10;border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;background-position: 10px center;">{{ Session::get('message')}}</div>  
        @endif
        
        <h2>Nuevo Ticket</h2>
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array(
        'url' => 'sistema',
        'method' => 'POST'
        )) }}
        
            <div class="form-group">
        		{{ Form::label('tiendas', 'Tienda') }}
        		{{ Form::select('tienda', $combo, $selected, array('class' => 'form-control')) }}
        	</div>
            
            <div class="form-group">
        		{{ Form::label('nombre', 'Nombre') }}
        		{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control')) }}
        	</div>
        
        	<div class="form-group">
        		{{ Form::label('paterno', 'Apellido Paterno') }}
        		{{ Form::text('paterno', Input::old('paterno'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('materno', 'Apellido Materno') }}
        		{{ Form::text('materno', Input::old('materno'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('fecha', 'Fecha') }}
        		{{ Form::text('fecha', Input::old('fecha'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('hora', 'Hora') }}
        		{{ Form::input('time', 'hora', Input::old('hora'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('edad', 'Edad') }}
        		{{ Form::text('edad', Input::old('edad'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('telefono', 'Tel&eacute;fono') }}
        		{{ Form::text('telefono', Input::old('telefono'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('ticket', 'No Ticket') }}
        		{{ Form::text('ticket', Input::old('ticket'), array('class' => 'form-control')) }}
        	</div>
            <div class="form-group">
        		{{ Form::label('mail', 'Mail') }}
        		{{ Form::text('mail', Input::old('mail'), array('class' => 'form-control')) }}
        	</div>

        
        	{{ Form::submit('Guardar Ticket', array('class' => 'btn btn-primary')) }}
        
        {{ Form::close() }}
    <script>
        $('#hora').timepicker();
        $(function() {
        $( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
      });
    </script>
@stop