<?php

class UsuariosController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home()
	{
		if(Auth::check()){
			return Redirect::to('sistema');
		}else{
			return View::make('usuarios.login');
		}
	}

	public function valid(){
		$email = Input::get('email');
		$password = Input::get('password');
		if (Auth::attempt(array('email' => $email, 'password' => $password))){
		    return Redirect::intended('sistema');
		}else{
			return Redirect::to('login');
		}
	}

}
