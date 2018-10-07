<?php namespace cteles\Http\Controllers\Auth;

use cteles\Http\Controllers\Controller;
use cteles\Models\Role;
use cteles\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Validator;

class AuthController extends Controller {


	protected $redirectTo = '/';   //Redireccionamiento de la ruta de autenticacion

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct()
	{
		//$this->auth = $auth;
		//$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);

	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{

		return Validator::make($data, [
			'username' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$new_user= User::create([
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'type' => $data['type'],
		]);

		/*  Se agrega el ROL para el usuario recien creado */
		$rol=Role::where('name','=',$data['type'])->first();
		$new_user->attachRole($rol);

		/* Se retorna el nuevo usuario creado */

		return $new_user;

	}

}
