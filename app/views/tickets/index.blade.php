@extends ('tickets.common')
@section('content')
        @if(Session::has('message'))
             <div style="background-color: #DFF2BF;color: #4F8A10;border: 1px solid;margin: 10px 0px;padding:15px 10px 15px 50px;background-repeat: no-repeat;background-position: 10px center;">{{ Session::get('message')}}</div>  
        @endif

@stop