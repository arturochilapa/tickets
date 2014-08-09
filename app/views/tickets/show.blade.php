@extends ('tickets.common')
@section ('titulo') Ver Tienda @stop
@section ('content')
    <div class="panel panel-default">
      <!-- Default panel contents -->
        <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> {{$tienda->clave}}</div>
        <div class="panel-body">
            <p>{{$tienda->nombre_tienda.' - '.$tienda->estado_tienda.' '.$tienda->municipio_tienda}} <a class="various fancybox.iframe" href="https://www.google.com/maps/embed/v1/view?key={{$key['maps']}}&center={{$tienda->latitud.','.$tienda->longitud}}&zoom=18">
<span class="glyphicon glyphicon-map-marker"></span></a> </p>
        </div>

      <!-- Table -->
        <table class="table">
            <thead>
            <tr>
                <th >Nombre Completo</th>
                <th >Total de Tickets</th>
            </tr>
            </thead>
    @foreach($tickets AS $t)
            <tr>
                <td>{{$t->nombre}}</td>
                <td>{{$t->total}}</td>
            </tr>
    @endforeach
        </table>
    </div>
    <script>
    $(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
    </script>
@stop