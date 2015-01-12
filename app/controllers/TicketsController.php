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
			$ticket->admin_user = Auth::id();
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
		
		$tickets = Tickets::select(DB::raw('CONCAT(nombre, " ", apellido_paterno, " ", apellido_materno) full, count(no_ticket) as total, tickets.id_tienda, CONCAT(tiendas.nombre_tienda, "(",  tiendas.clave, ")") as tienda'))
		->groupBy(DB::raw('CONCAT(nombre, " ", apellido_paterno, " ", apellido_materno)'))
		->join('tiendas', 'tiendas.id_tienda', '=', 'tickets.id_tienda')
		->orderBy('tiendas.clave', 'asc')
		->orderBy('total', 'desc')
		->get();
		
		$list = array();
		$i = 1;
		foreach($tickets as $ticket){

			if(@count($list[$ticket->id_tienda]) < 5){
				
				$list[$ticket->id_tienda][$i]['nombre'] = $ticket->full;
				$list[$ticket->id_tienda][$i]['total'] = $ticket->total;
				//$list[$ticket->id_tienda]['tienda'] = $ticket->tienda;
			}

			//echo @count($list[$ticket->id_tienda]).' ----' . $ticket->id_tienda .'<br>';
			$i++;
		}

		$html = '<html><body>';
		foreach($list as $key => $item){
			//print_r($item);
			$tiendaNombre = Tienda::find($key);
			$html .= '<table style="width:700px;border: 1px solid;" cellspacing="0" cellpadding="0">';
			$html .= '<tr style="background-color: #FCEAA5;"><td colspan="2" align="center">'.$tiendaNombre->nombre_tienda. '('. $tiendaNombre->clave .')</td></tr>';
			$html .= '<tr style="background-color: #FCEAA5;">';
			$html .= '<td width="70%" align="center"><b>Nombre</b></td>';
			$html .= '<td align="center"><b>Tickets</b></td>';
			$html .= '</tr>';
			foreach ($item as $value) {
				$html .= '<tr style="height:35px;">';
				$html .= '<td style="border-top: 1px solid;padding-left: 15px;height:35px;font-family:Verdana;">'.$value['nombre'].'</td>';
				$html .= '<td style="border-top: 1px solid;" align="center">'.$value['total'].'</td>';
				$html .= '</tr>';
			}
			$html .= '</table><br>';
		}
		
		$html .= '</body></html>';
		return PDF::load($html, 'A4', 'portrait')->show();
		//return PDF::load($html, 'Letter', 'portrait')->download('Lista_Ganadores');
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

	public function globalExcel(){
		$excel = App::make('excel');
		$data = Tickets::select(DB::raw('(tickets.id_ticket) AS Number'), 'tiendas.clave', DB::raw('(
		SELECT count(*) AS t
		FROM tickets AS temp
		WHERE 
			temp.nombre = tickets.nombre
			AND temp.apellido_paterno = tickets.apellido_paterno
			AND temp.apellido_materno = tickets.apellido_materno
	)AS ticket_registrados'),'tickets.nombre','tickets.apellido_paterno','tickets.apellido_materno','tickets.fecha','tickets.edad','tickets.telefono', DB::raw('CONCAT(" ", tickets.no_ticket) AS ticket'),'tickets.mail', 'tiendas.clave', DB::raw('CONCAT(tiendas.clave, " ", tiendas.nombre_tienda) AS nombre_tienda'), 'tiendas.municipio_tienda')
		->join('tiendas', 'tickets.id_tienda', '=', 'tiendas.id_tienda')
		->get();

		Excel::create('Reporte_Global', function($excel) use($data) {
		
			$excel->sheet('Hoja', function($sheet) use($data) {
		
				$sheet->fromModel($data);
		
			});
		
		})->export('xls');
	}
	
	public function excel($id){
		$excel = App::make('excel');
		

		$foo = '';
		$data = Tickets::where('tiendas.id_tienda', '=', $id)
		->select(DB::raw('(tickets.id_ticket) AS Number'), 'tiendas.clave', DB::raw('(
		SELECT count(*) AS t
		FROM tickets AS temp
		WHERE 
			temp.nombre = tickets.nombre
			AND temp.apellido_paterno = tickets.apellido_paterno
			AND temp.apellido_materno = tickets.apellido_materno
	)AS ticket_registrados'),'tickets.nombre','tickets.apellido_paterno','tickets.apellido_materno','tickets.fecha','tickets.edad','tickets.telefono', DB::raw('CONCAT(" ", tickets.no_ticket) AS ticket') ,'tickets.mail', DB::raw('CONCAT(tiendas.clave, " ", tiendas.nombre_tienda) AS nombre_tienda'), 'tiendas.municipio_tienda')
		->join('tiendas', 'tickets.id_tienda', '=', 'tiendas.id_tienda')
		
		

		->get();

		
		Excel::create('Reporte', function($excel) use($data) {
		
			$excel->sheet('Sheetname', function($sheet) use($data) {
		
				$sheet->fromModel($data);
		
			});
		
		})->export('xls');
	}


}
