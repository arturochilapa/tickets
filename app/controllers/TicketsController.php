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
        return View::make('tickets.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tiendas_list = Tienda::lists('clave', 'id_tienda');
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
            return Redirect::to('create')->withErrors($validator);
        } else {

            $ticket = new Tickets;
            $ticket->id_tienda = Input::get('tienda');
            $ticket->nombre = Input::get('nombre');
            $ticket->apellido_paterno = Input::get('paterno');
            $ticket->apellido_materno = Input::get('materno');
            $ticket->fecha = Input::get('fecha');
            $ticket->edad = Input::get('edad');
            $ticket->telefono = Input::get('telefono');
            $ticket->no_ticket = Input::get('ticket');
            $ticket->mail = Input::get('mail');
            $ticket->save();
            Session::flash('message', 'Ticket Creado Correctamente.');
            Session::flash('id_tienda', Input::get('tienda'));
            return Redirect::to('/create');

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function winners()
    {
        return View::make('tickets.winners');
    }

    public function searchTicket()
    {
        $q = Input::get('q');
        $t = Tickets::where("nombre", 'LIKE' , '%'.$q.'%')
        ->orWhere("apellido_paterno", 'LIKE' , '%'.$q.'%')
        ->orWhere("apellido_materno", 'LIKE' , '%'.$q.'%')
        ->orWhere("no_ticket", 'LIKE' , '%'.$q.'%')
        ->orWhere("telefono", 'LIKE' , '%'.$q.'%')
        ->get();
        return View::make('tickets.search', compact('t'));
        

    }


}
