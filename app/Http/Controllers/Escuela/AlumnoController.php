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
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request){
        $curp=$request->get('curp');

		if(!isset($curp) || trim($curp)==='') {

			$alumnos = $this->alumnoRepo->all();
		}
		else{

			$alumnos=$this->alumnoRepo->retrieveAlumnoByCurp($curp);

		}
        $curp_request=\Request::all();
		$cct=$this->alumnoRepo->findCentroTrabajoByUser(\Auth::user()->id)->cct;
		$cct_nombre=$this->alumnoRepo->findCentroTrabajoByUser(\Auth::user()->id)->nombre;
		$TituloTabla=$cct.' '.$cct_nombre;

        if($request->ajax()){

			return view('alumnos.tabladatos',compact('TituloTabla','alumnos','curp_request')); //paginacion via ajax
		}
        //return response()->json($alumnos);
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
	 * @param CreateAlumnoRequest $input
	 * @return Response

	 *
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
	 * @param $alumno_id
	 * @param EditAlumnoRequest $request
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
	public function destroy($id,Request $request){
		if($request->ajax()){

			if($this->alumnoRepo->delete($id)){
				$rs=[
				   'id'=>$id,
				   'status'=>'1',
				   'mensaje'=>'Alumno Eliminado',
				];
			}

			return response()->json($rs,200);
		}
		return response()->json([
                                'status'=>'0',
			                    'mensaje'=>'Error al eliminar el registro',
		                        ],422);
	}


	/**
	 * @param $id
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function getAlumnoJson($id,Request $request){

		if($request->ajax()){
			$alumno=$this->alumnoRepo->findAlumnoById($id);
			//dd(Response::json($alumno));
			return response()->json($alumno,200);
		}
		Flash::error('No es posible procesar su peticion');
		return redirect(url('/home'));
	}

	/**
	 * @param $id
	 * @param EditAlumnoRequest $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function updateAjax($id,EditAlumnoRequest $request){

		if($request->ajax()){
            $respuesta=$this->alumnoRepo->update($id,$request);

			switch($respuesta['http_respuesta']){
				case 200:
					if($respuesta['modificado']==100){     // VALOR DE 100 PARA "MODIFICADO",
						$alumno=$this->alumnoRepo->retrieveAlumnoTutor($id);
						$tutores=array();
						foreach($alumno->padretutores as $tutor){
							$tutores[]=$tutor;
						}
						$a=([
							'id'=>$alumno->id,
							'curp'=>$alumno->curp,
							'nombre'=>$alumno->nombre,
							'appaterno'=>$alumno->appaterno,
							'apmaterno'=>$alumno->apmaterno,
							'localidad'=>$alumno->localidad,
							'domicilio'=>$alumno->domicilio,
							'padretutores'=>$tutores,
							'status'=>'1',
							'mensaje'=>'Informacion actualizada con exito!'
						]);
					}else{   //VALOR DE 101 PARA "SIN MODIFICAR"
						$a=([

							'status'=>'0',
							'mensaje'=>'No se realizo ningun cambio en la informacion para actualizar'
						]);
					}

					break;
				case 422:  // Cuando la curp ya existe en la base de datos
					$a=([
                        'mensaje'=>'CURP ya existe en la base de datos.'

					]);
					break;
			}

            return response()->json($a,$respuesta['http_respuesta']);
		}
	}



}
