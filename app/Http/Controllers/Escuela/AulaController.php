<?php namespace cteles\Http\Controllers\Escuela;


use cteles\Http\Controllers\Controller;


use cteles\Http\Requests\CreateAulaRequest;
use cteles\Models\Centrotrabajo;
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
     * @return \Illuminate\View\View
     */
	public function index(Request $request)	{
		//if(\Entrust::hasRole('director')) {
			$ct_id = User::find(\Auth::user()->id)->docente->centrotrabajo_id;
			$TituloTabla = Centrotrabajo::find($ct_id)->nombre_completo;

            $aulas_asignadas=$this->aulaRepo->all($ct_id);

			//dd($aulas_asignadas);
			return view('aula.index', compact('TituloTabla','aulas_asignadas'));
		//}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create(){
		//if(\Entrust::hasRole('director')){
			$ct_id=User::find(\Auth::user()->id)->docente->centrotrabajo_id;
			$docentes=$this->docenteRepo->retrieveAllDocenteByCT($ct_id)->lists('curp_nombrecompleto','id');
            $turnos=$this->turnoRepo->all()->lists('nom_turno','id');
			$grupos=$this->grupoRepo->all()->lists('nom_grupo','id');
			$grados=$this->gradoRepo->all()->lists('nom_grado','id');
			$ciclos=$this->cicloescolarRepo->all()->lists('ciclo','id');
			$aulas_asignadas=$this->aulaRepo->all($ct_id);
			$TituloTabla=Centrotrabajo::find($ct_id)->nombre_completo;

			return view('aula.create',compact('docentes','turnos','grupos','grados','ciclos','TituloTabla','aulas_asignadas'));
		//}
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAulaRequest $aulaRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(CreateAulaRequest $aulaRequest){
          $this->aulaRepo->store($aulaRequest);
		  Flash::info('Docente Asignado con Exito al Aula');
		  return redirect('/escuela/aulas/create');

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
	public function destroy($id,Request $request){



	}

    public function destroyAjax($id,Request $request){
		if($request->ajax()){
			if($this->aulaRepo->delete($id)){
				return response()->json([
					'status'=>'1',
					'mensaje'=>'Docente eliminado del Aula asignada'
				],200);
			}
			return response()->json([    //Error si no se ha podido eliminar el registro

				'mensaje'=>'Ha ocurrido un error, favor de intenterlo mas tarde'
			],422);
		}
		Flash::error('No es posible procesar su peticion');
		return redirect(url('/home'));
	}


}
