<?php namespace cteles\Http\Requests;

use cteles\Http\Requests\Request;
use cteles\Models\Alumno;

class CreateAlumnoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return Alumno::$rules;
	}

}
