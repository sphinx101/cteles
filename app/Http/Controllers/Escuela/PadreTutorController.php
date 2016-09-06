<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Requests;
use cteles\Http\Controllers\Controller;
use cteles\Repositorios\AlumnoRepo;
use cteles\Repositorios\PadretutorRepo;
use Illuminate\Http\Request;

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

        $pt=$this->tutorRepo->all();
		return (response()->json($pt));


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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,Request $request){
        $tutor=$this->tutorRepo->show($id);
		$campo_desactivado='disabled';
		return view('padretutor.show',compact('tutor','campo_desactivado'));
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
