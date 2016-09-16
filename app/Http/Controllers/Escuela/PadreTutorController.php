<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Requests;
use cteles\Http\Controllers\Controller;
use cteles\Models\Alumno;
use cteles\Repositorios\AlumnoRepo;
use cteles\Repositorios\PadretutorRepo;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PadreTutorController extends Controller {

    private $alumnoRepo;
	private $tutorRepo;


	/**
	 * @param PadretutorRepo $tutorRepo
	 * @param AlumnoRepo $alRepo
     */
	public function __construct(PadretutorRepo $tutorRepo,AlumnoRepo $alumnoRepo){
	       $this->tutorRepo=$tutorRepo;
		   $this->alumnoRepo=$alumnoRepo;

	}

	/**
	 * Display a listing of the PadreTutor.
	 *
	 * @return Response
	 */
	public function index(Request $request){
		$nombre=$request->get('nombre');
		$paterno=$request->get('paterno');
		$buscar_request=$request->all();

		if((!isset($nombre) || trim($nombre)==='') && (!isset($paterno) || trim($paterno)==='')) {

			$paginaciontotal= $this->tutorRepo->all();
		}
		else{

			$paginaciontotal=$this->tutorRepo->searchTutores($nombre,$paterno);

		}


		$pt=$paginaciontotal['paginador'];
		$total_registrados=$paginaciontotal['total_registros'];
		$TituloTabla=$paginaciontotal['centrotrabajo'];
		//dd($pt);
		return view('padretutor.index',compact('pt','total_registrados','TituloTabla','buscar_request'));
	}

	/**
	 * Show the form for creating a new PadreTutor.
	 *
	 * @return Response
	 */
	public function create(){
		$campo_desactivado='';

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * @param $id
	 * @param Request $request
	 * @return \Illuminate\View\View
     */
	public function show($id,Request $request){

        if($this->tutorRepo->checkRelationTutorAlumno($request->get('alumno_id'),$id)) {
			$tutor = $this->tutorRepo->show($id, $request);
			$tipo_parentesco = $this->tutorRepo->findTutorParentescoById($tutor->pivot->parentesco_id)->tipo;
			$alumno = $this->alumnoRepo->findAlumnoById(($request['alumno_id']));
			$campo_desactivado = 'disabled';

			return view('padretutor.show', compact('tutor', 'tipo_parentesco', 'alumno', 'campo_desactivado'));
		}
		Flash::error('No es posible procesar su peticion');
		return redirect(url('/home'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		dd('formulario para editar');
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

}
