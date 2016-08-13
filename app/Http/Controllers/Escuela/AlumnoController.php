<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Controllers\Controller;
use cteles\Http\Requests;
use cteles\Http\Requests\CreateAlumnoRequest;
use cteles\Http\Requests\EditAlumnoRequest;
use cteles\Models\Alumno;
use cteles\Repositorios\AlumnoRepo;
use cteles\Repositorios\CentrotrabajoRepo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Mitul\Generator\Utils\ResponseManager;
use Response;

class AlumnoController extends Controller{
	/**
	 * @var AlumnoRepo
	 */
	private $alumnoRepo;
	/**
	 * @var CentrotrabajoRepo
	 */
	private $centrotrabajoRepo;

	/**
	 * AlumnoController constructor.
	 * @param AlumnoRepo $alumnoRepo
	 * @param CentrotrabajoRepo $centrotrabajoRepo
	 */
	public function __construct(AlumnoRepo $alumnoRepo,CentrotrabajoRepo $centrotrabajoRepo){
		$this->alumnoRepo = $alumnoRepo;
		$this->centrotrabajoRepo = $centrotrabajoRepo;
	}


	/**
	 * Display a listing of the Alumno.
	 *
	 * @return Response
	 */
	public function index(Request $request){
        $curp=$request->get('curp');

		if(!isset($curp) && trim($curp)!='') {

			$alumnos = $this->alumnoRepo->all();
		}
		else{
			$alumnos=$this->alumnoRepo->retrieveAlumnoByCurp($curp);

		}
        $curp_request=\Request::all();
		$TituloTabla=$this->alumnoRepo->findCentroTrabajoByUser(\Auth::user()->id)->nombre;


		return view('alumnos.index',compact('TituloTabla','alumnos','curp_request'));

	}

	/**
	 * Show the form for creating a new Alumno.
	 *
	 * @return Response
	 */
	public function create(){

		//dd('formulario registro de alumno');
		$titulo='Nuevo/PreInscripcion Alumno    TODOS LOS CAMPOS SON OBLIGATORIOS';
		$ccts=$this->centrotrabajoRepo->findCentrotrabajoByUserId(Auth::user()->id)->id;
		$etiquetaBoton='Guardar';
		return view('alumnos.create')->with('titulo',$titulo)->with('ccts',$ccts)->with('etiquetaBoton',$etiquetaBoton);
	}

	/**
	 * Store a newly created Alumno in storage.
	 *
	 * @param CreateAlumnoRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateAlumnoRequest $input){

		$this->alumnoRepo->store($input);
		Flash::info('Alumno Registrado con Exito');
		return redirect(url('/home'));
	}

	/**
	 * Display the specified Alumno.
	 *
	 * @param  int  $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function show($id)
	{
		dd('vista para ver alumno especifico');
	}

	/**
	 * Show the form for editing the specified Alumno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($alumno_id){
		$titulo='Editar Datos Alumno';
        $etiquetaBoton='Actualizar';
        $alumno=$this->alumnoRepo->findAlumnoById($alumno_id);

        return view('alumnos.edit',compact('titulo','etiquetaBoton','alumno'));

	}

	/**
	 * Update the specified Alumno in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($alumno_id, EditAlumnoRequest $request){
        if($this->alumnoRepo->update($alumno_id,$request)){
            Flash::info('Alumnno Actualizado con Exito');
        }else{
            Flash::error('No se realizo ningun cambio en la informacion para actualizar');
        }

        return redirect(url('/escuela/alumnos'));
	}

	/**
	 * Remove the specified Alumno from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

	public function getAlumnoJson($id,Request $request){

		if($request->ajax()){
			$alumno=$this->alumnoRepo->findAlumnoById($id);
			//dd(Response::json($alumno));
			return Response::json($alumno,200);
		}
		Flash::error('No es posible procesar su peticion');
		return redirect(url('/home'));
	}
	public function updateAjax($id,Request $request){
		if($request->ajax()){
			return response()->json(['mensaje'=>'funciona']);
		}
	}

}
