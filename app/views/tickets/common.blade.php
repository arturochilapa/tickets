@if(empty($q))
    {{$q = ''}}
@else

@endif
<!DOCTYPE html>
<html>
<head>
	<title>@yield('titulo', 'Tickets Fay Publicidad')</title>
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
                <li {{(Request::is('/') ? 'class="active"' : '')}}><a href="/">Inicio</a></li>
                <li {{(Request::is('create') ? 'class="active"' : '')}}><a href="{{URL::to('create')}}">Nuevo Ticket</a></li>
                <li {{(Request::is('winners') ? 'class="active"' : '')}}><a href="{{URL::to('winners')}}">Ganadores</a></li>
              </ul>
              <form class="navbar-form navbar-left" role="search" method="post" action="/search">
                <div class="form-group">
                  <input type="text" value="{{$q}}" class="form-control" name="q" placeholder="B&uacute;scar" />
                </div>
                <button type="submit" class="btn btn-default">B&uacute;scar</button>
              </form>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>
    <div style="margin: 50px;">
    @yield('content')
    </div>
    </body>
</html>