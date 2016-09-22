<?php namespace cteles\Http\Controllers\Escuela;


use cteles\Http\Controllers\Controller;


use cteles\Http\Requests\CreateAulaRequest;
use cteles\Models\Centrotrabajo;
use cteles\Models\Docente;
use cteles\Models\Grupo;
use cteles\Repositorios\AulaRepo;
use cteles\Repositorios\CicloescolarRepo;
use cteles\Repositorios\DocenteRepo;


use cteles\Repositorios\GradoRepo;
use cteles\Repositorios\GrupoRepo;
use cteles\Repositorios\TurnoRepo;
use cteles\User;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use Laracasts\Flash\Flash;



class AulaController extends Controller {

	private $aulaRepo;
	private $docenteRepo;
	private $turnoRepo;
	private $grupoRepo;
	private $gradoRepo;
	private $cicloescolarRepo;

	public  function __construct(AulaRepo $aulaRepo,DocenteRepo $docenteRepo,
	                             TurnoRepo $turnoRepo,GrupoRepo $grupoRepo,
                                 GradoRepo $gradoRepo,CicloescolarRepo $cicloescolarRepo){
		$this->aulaRepo=$aulaRepo;
		$this->docenteRepo=$docenteRepo;
		$this->turnoRepo=$turnoRepo;
		$this->grupoRepo=$grupoRepo;
		$this->gradoRepo=$gradoRepo;
		$this->cicloescolarRepo=$cicloescolarRepo;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 */
	public function index(Request $request)	{
          return view('aula.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create(){
		if(\Auth::user()->type=='director'){
			$ct_id=User::find(\Auth::user()->id)->docente->centrotrabajo_id;
			$docentes=$this->docenteRepo->retrieveAllDocenteByCT($ct_id)->lists('curp_nombrecompleto','id');
            $turnos=$this->turnoRepo->all()->lists('nom_turno','id');
			$grupos=$this->grupoRepo->all()->lists('nom_grupo','id');
			$grados=$this->gradoRepo->all()->lists('nom_grado','id');
			$ciclos=$this->cicloescolarRepo->all()->lists('ciclo','id');
			$TituloTabla=Centrotrabajo::find($ct_id)->nombre_completo;


			return view('aula.create',compact('docentes','turnos','grupos','grados','ciclos','TituloTabla'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 *
	 */
	public function store(CreateAulaRequest $aulaRequest){
        dd($aulaRequest->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 *
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 */
	public function destroy($id)
	{
		//
	}




}
