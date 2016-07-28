<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Controllers\Controller;
use cteles\Http\Requests;
use cteles\Models\Alumno;
use cteles\Repositorios\AlumnoRepo;
use cteles\Repositorios\CentrotrabajoRepo;
use Illuminate\Http\Request;

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
		dd('listado alumnos');
	}

	/**
	 * Show the form for creating a new Alumno.
	 *
	 * @return Response
	 */
	public function create()
	{
		dd('formulario para pre-inscripcion de alumno');
	}

	/**
	 * Store a newly created Alumno in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

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
