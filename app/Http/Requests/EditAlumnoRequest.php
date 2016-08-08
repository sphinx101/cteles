<?php namespace cteles\Http\Requests;

use cteles\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditAlumnoRequest extends Request {

	private $route;


	/**
	 * EditAlumno constructor.
	 * @param Route $route
     */
	public function __construct(Route $route){
		$this->route=$route;

	}


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
		return [
			'curp'=>'required|unique:alumnos,curp,'.$this->route->getParameter('alumnos'),
			'nombre'=>'required',
			'appaterno'=>'required',
			'apmaterno'=>'required'
		];
	}

}
