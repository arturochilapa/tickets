@extends ('tickets.common')
@section ('titulo') Ver Tienda @stop
@section ('content')
    <div class="panel panel-default">
      <!-- Default panel contents -->
        <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> {{$tienda->clave}}</div>
        <div class="panel-body">
            <p>{{$tienda->nombre_tienda.' - '.$tienda->estado_tienda.' '.$tienda->municipio_tienda}} <span class="glyphicon glyphicon-map-marker"></span> </p>
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
@stop