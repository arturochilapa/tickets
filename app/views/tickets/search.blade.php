@extends ('tickets.common')
@section('titulo')Buscando "{{$q}}" @stop
@section('content')
<div class="panel panel-default" style="width: 70%;margin:auto;">
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
        <td><a href="{{URL::to('/sistema/'.$value->id_ticket. '/edit')}}" class="btn btn-info btn-lg active btn-sm" role="button">Editar</a>
        {{ Form::open(array('url' => 'sistema/' . $value->id_ticket, 'class' => 'pull-right')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			{{ Form::submit('Eliminar', array('class' => 'btn btn-warning')) }}
		{{ Form::close() }}
        </td>
    </tr>
@endforeach
</table>
</div>
@stop