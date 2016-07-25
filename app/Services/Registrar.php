<?php namespace cteles\Services;

use cteles\Models\Role;
use cteles\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

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
