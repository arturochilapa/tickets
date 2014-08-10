@extends ('tickets.common')
@section('content')
        @if(Session::has('message'))
             <div style="background-color: #DFF2BF;color: #4F8A10;border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;background-position: 10px center;">{{ Session::get('message')}}</div>  
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Últimas tiendas agregadas.</h3>
          </div>
          <div class="panel-body">
           <div class="list-group">
          @foreach ($tiendas AS $total)
                <a href="{{URL::to('/sistema/tienda/ver/'.$total->id_tienda)}}" class="list-group-item">
                  <span class="badge pull-right">{{$total->total}}</span>
                  {{$total->clave}} {{$total->nombre_tienda}}
                </a>
          @endforeach
            </div>
          </div>
        </div>

@stop