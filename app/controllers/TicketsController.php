<?php

class TicketsController extends \BaseController
{

    //public $layout = 'layouts.common';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tiendas  = DB::table('tickets')
            ->join('tiendas', 'tiendas.id_tienda', '=', 'tickets.id_tienda')
            ->select('tiendas.clave', 'tiendas.nombre_tienda', DB::raw('count(*) AS total'), 'tiendas.id_tienda')
            ->groupBy('tickets.id_tienda')
            ->take(10)
            ->get();
        
        return View::make('tickets.index', compact('tiendas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tiendas_list = Tienda::orderBy('clave', 'asc')->lists('clave', 'id_tienda');
        $combo = array(0 => "Seleccione ... ") + $tiendas_list;
        $selected = array(Session::get('id_tienda'));
        return View::make('tickets.create', compact('combo', 'selected'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'tienda' => 'not_in:0',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'fecha' => 'required|date',
            'edad' => 'required',
            'telefono' => 'required',
            'ticket' => 'required|unique:tickets,no_ticket');

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/sistema/create')->withErrors($validator);
        } else {
            $fecha = Input::get('fecha') . ' '. Input::get('hora');
            $ticket = new Tickets;
            $ticket->id_tienda = Input::get('tienda');
            $ticket->nombre = Input::get('nombre');
            $ticket->apellido_paterno = Input::get('paterno');
            $ticket->apellido_materno = Input::get('materno');
            $ticket->fecha = $fecha;
            $ticket->edad = Input::get('edad');
            $ticket->telefono = Input::get('telefono');
            $ticket->no_ticket = Input::get('ticket');
            $ticket->mail = Input::get('mail');
            $ticket->save();
            Session::flash('message', 'Ticket Creado Correctamente.');
            Session::flash('id_tienda', Input::get('tienda'));
            return Redirect::to('/sistema/create');

        }
    }
    
    /**
     * Display the specified store.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Display the specified store.
     *
     * @param  int  $id
     * @return Response
     */
    public function tienda($id)
    {
        $tienda = Tienda::find($id);
        $key = array('maps' => 'AIzaSyCI_HJC8FW7cZikRAgqb6W5rYcVZkRcQ5I');
        $tickets  = DB::table('tickets')
            ->select(DB::raw('CONCAT(nombre, " ", apellido_paterno, " ", apellido_materno) AS nombre, COUNT(*) AS total'))
            ->where('id_tienda', '=', $tienda->id_tienda)
            ->groupBy('nombre', 'apellido_paterno', 'apellido_materno')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();
        
        return View::make('tickets.show', compact('tienda', 'tickets', 'key'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ticket = Tickets::find($id);
        
        $tiendas_list = Tienda::lists('clave', 'id_tienda');
        $combo = array(0 => "Seleccione ... ") + $tiendas_list;
        
        
        return View::make('tickets.edit', compact('ticket', 'combo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Responses
     */
    public function update($id)
    {
        $rules = array(
            'tienda' => 'not_in:0',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'fecha' => 'required|date',
            'edad' => 'required',
            'telefono' => 'required',
            'no_ticket' => 'required');

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/sistema/'.$id.'/edit')->withErrors($validator);
        } else {
            $ticket = Tickets::find($id);
            $ticket->id_tienda = Input::get('tienda');
            $ticket->nombre = Input::get('nombre');
            $ticket->apellido_paterno = Input::get('apellido_paterno');
            $ticket->apellido_materno = Input::get('apellido_materno');
            $ticket->fecha = Input::get('fecha');
            $ticket->edad = Input::get('edad');
            $ticket->telefono = Input::get('telefono');
            $ticket->no_ticket = Input::get('no_ticket');
            $ticket->mail = Input::get('mail');
            $ticket->save();
            $tiendas  = DB::table('tickets')
            ->join('tiendas', 'tiendas.id_tienda', '=', 'tickets.id_tienda')
            ->select('tiendas.clave', 'tiendas.nombre_tienda', DB::raw('count(*) AS total'), 'tiendas.id_tienda')
            ->groupBy('tickets.id_tienda')
            ->take(10)
            ->get();
            
        }
        Session::flash('message', 'Ticket Actualizado Correctamente.');
        return View::make('tickets.index', compact('tiendas'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ticket = Tickets::find($id);
        $ticket->delete();
        Session::flash('message', 'Ticket borrado Satisfactoriamente');
		return Redirect::to('sistema');
    }

    public function winners()
    {
        return View::make('tickets.winners');
    }

    public function searchTicket()
    {
        $q = Input::get('q');
        /*
        $t = Tickets::where("nombre", 'LIKE' , '%'.$q.'%')
        ->orWhere("apellido_paterno", 'LIKE' , '%'.$q.'%')
        ->orWhere("apellido_materno", 'LIKE' , '%'.$q.'%')
        ->orWhere("no_ticket", 'LIKE' , '%'.$q.'%')
        ->orWhere("telefono", 'LIKE' , '%'.$q.'%')
        ->get();
        */
        $t = Tickets::where('tickets.nombre','like','%' .$q. '%')
        ->join('tiendas', 'tiendas.id_tienda', '=', 'tickets.id_tienda')
        ->orWhere('tiendas.clave', 'LIKE', '%'. $q .'%')
        ->orWhere("apellido_paterno", 'LIKE' , '%'.$q.'%')
        ->orWhere("apellido_materno", 'LIKE' , '%'.$q.'%')
        ->orWhere("no_ticket", 'LIKE' , '%'.$q.'%')
        ->orWhere("telefono", 'LIKE' , '%'.$q.'%')
        ->orWhere("tickets.fecha", 'LIKE' , ''.$q.'%')
        ->select('tickets.id_ticket', 'tickets.nombre', 'tickets.apellido_paterno', 'tickets.apellido_materno', 'tickets.fecha', 'tiendas.clave', 'tickets.no_ticket', 'tickets.id_tienda')
        ->get();
        
        return View::make('tickets.search', compact('t', 'q'));
        

    }
    
    public function excel($id){
        $excel = App::make('excel');
        
        /*
select
(@cnt := @cnt + 1) AS rowNumber, 
tiendas.clave,
	(
		SELECT count(*) AS t
		FROM tickets AS temp
		WHERE 
			temp.nombre = tickets.nombre
			AND temp.apellido_paterno = tickets.apellido_paterno
			AND temp.apellido_materno = tickets.apellido_materno
	),
tickets.nombre,
tickets.apellido_paterno,
tickets.apellido_materno,
tickets.fecha,
tickets.edad,
tickets.telefono,
tickets.no_ticket,
tickets.mail,
CONCAT(tiendas.clave, ' ', tiendas.nombre_tienda) AS nombre_tienda,
tiendas.municipio_tienda
from tickets
CROSS JOIN (SELECT @cnt := 0) AS row
Inner join tiendas ON (tickets.id_tienda = tiendas.id_tienda)
Where tiendas.id_tienda = 98
        
        */
        $foo = '';
        $data = Tickets::where('tiendas.id_tienda', '=', $id)
        ->select(DB::raw('(@cnt := @cnt + 1) AS Number'), 'tiendas.clave', DB::raw('(
		SELECT count(*) AS t
		FROM tickets AS temp
		WHERE 
			temp.nombre = tickets.nombre
			AND temp.apellido_paterno = tickets.apellido_paterno
			AND temp.apellido_materno = tickets.apellido_materno
	)AS ticket_registrados'),'tickets.nombre','tickets.apellido_paterno','tickets.apellido_materno','tickets.fecha','tickets.edad','tickets.telefono', DB::raw('CONCAT(" ", tickets.no_ticket) AS ticket') ,'tickets.mail', DB::raw('CONCAT(tiendas.clave, " ", tiendas.nombre_tienda) AS nombre_tienda'), 'tiendas.municipio_tienda')
        ->join('tiendas', 'tickets.id_tienda', '=', 'tiendas.id_tienda')
        
        

        ->get();

        
        Excel::create('Filename', function($excel) use($data) {
        
            $excel->sheet('Sheetname', function($sheet) use($data) {
        
                $sheet->fromModel($data);
        
            });
        
        })->export('xls');
    }


}
