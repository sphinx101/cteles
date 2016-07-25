<?php namespace cteles\Http\Requests;

use cteles\Http\Requests\Request;
use cteles\Models\Docente;
use Illuminate\Routing\Route;

class EditDocenteRequest extends Request {
    /**
     * @var Route
     */
    private $route;

    /**
     * EditDocenteRequest constructor.
     * @param Route $route
     */
    public function __construct(Route $route){
        $this->route = $route;
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
	public function rules()	{

		return $rules=[
            'centrotrabajo_id' => 'required',

            'rfc' => 'required|unique:docentes,rfc,'.$this->route->getParameter('docentes'),
            'curp' =>'required|unique:docentes,curp,'.$this->route->getParameter('docentes'),
            'nombre'=>'required',
            'appaterno'=>'required',
            'apmaterno'=>'required'
        ];
	}

}
