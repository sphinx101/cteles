<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Controllers\Controller;
use cteles\Http\Requests;
use cteles\Http\Requests\CreateAlumnoRequest;
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
	public function index(){
		$alumnos=$this->alumnoRepo->all();
		$TituloTabla=$this->alumnoRepo->findCentroTrabajoByUser(\Auth::user()->id)->nombre;


		return view('alumnos.index',compact('TituloTabla','alumnos'));

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
	public function edit($id)
	{
		dd('formulario para editar alumno');
	}

	/**
	 * Update the specified Alumno in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{

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

}
