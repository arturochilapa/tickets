<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Ticket</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>  
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/blitzer/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <header class="top" role="header">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="/img/fay.png" height="30px" /></a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="#">Inicio</a></li>
                <li class="active"><a href="#">Nuevo Ticket</a></li>
                <li><a href="#">Ganadores</a></li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="B&uacute;scar">
                </div>
                <button type="submit" class="btn btn-default">B&uacute;scar</button>
              </form>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>
    <div style="margin: 50px;">
        <h2>Nuevo Ticket</h2>
        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => 'tickets')) }}
        
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
    </div>
    <script>
        $(function() {
        $( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
      });
    </script>

</body>
</html>