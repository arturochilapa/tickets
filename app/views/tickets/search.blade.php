@extends ('tickets.common')
@section('content')
<div class="panel panel-default">
<div class="panel-heading">Resultado de la busqueda <strong>"{{$q}}"</strong></div>
<table class="table">
<thead>
    <tr>
        <th>ID</th>
        <th>No Ticket</th>
        <th>Fecha</th>
        <th>Nombre Completo</th>
        <th>Acci&oacute;n</th>
    </tr>
</thead>
@foreach($t as $key=>$value)
    <tr>
        <td>{{$value['id_ticket']}}</td>
        <td>{{$value['no_ticket']}}</td>
        <td>{{$value['fecha']}}</td>
        <td>{{$value['nombre']." ".$value['apellido_paterno']." ".$value['apellido_materno']}}</td>
        <td><a href="{{URL::to($value->id_ticket. '/edit')}}" class="btn btn-info btn-lg active btn-sm" role="button">Editar</a></td>
    </tr>
@endforeach
</table>
</div>
@stop