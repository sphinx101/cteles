<?php namespace cteles\Http\Controllers\Escuela;

use cteles\Http\Requests;
use cteles\Http\Controllers\Controller;


use cteles\Http\Requests\CreateDocenteRequest;
use cteles\Http\Requests\EditDocenteRequest;
use cteles\Repositorios\CentrotrabajoRepo;
use cteles\Repositorios\DocenteRepo;
use cteles\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class DocenteController extends Controller {


    /**
     * @var DocenteRepo
     */
    private $docenteRepo;
	/**
	 * @var CentrotrabajoRepo
	 */
	private $ctRepo;

	function __construct(DocenteRepo $docenteRepo,CentrotrabajoRepo $ctRepo){

        $this->docenteRepo = $docenteRepo;
		$this->ctRepo = $ctRepo;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()	{
        $docentes=$this->docenteRepo->all();
        $TituloTabla='TODOS';
        $i=0;
        if (\Auth::user()->type!='admin') {
            $TituloTabla = $this->docenteRepo->findDocenteByUserId(\Auth::user()->id)->centrotrabajo->nombre;
        }

        return view('docentes.index',compact('docentes','TituloTabla','i'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()	{
        $titulo='Registro Docente';
		$ccts=$this->ctRepo->listCCT();
		$etiquetaBoton='Aceptar';


		return view('docentes.create')->with('titulo',$titulo)->with('ccts',$ccts)->with('etiquetaBoton',$etiquetaBoton);
	}

	/**
	 * Store a newly created resource in storage.
	 * @param CreateDocenteRequest $input
	 * @return Response
	 * @internal param $CreateDocenteRequest
	 */
	public function store(CreateDocenteRequest $input)	{

		$this->docenteRepo->store($input);
		Flash::info('Docente registrado con exito.');
		return redirect(url('/home'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
        $this->docenteRepo->show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($user_id)	{
		//dd(\Auth::user()-
		$titulo='Editar Docente';
		$ccts=$this->ctRepo->listCCT();
		$etiquetaBoton='Actualizar';
        $docente=$this->docenteRepo->findDocenteByUserId($user_id);
       // dd($docente);
		return view('docentes.edit',compact('titulo','ccts','etiquetaBoton','docente'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id_docente,EditDocenteRequest $request)	{
        $mensaje=null;
		$url=null;
		dd($request->all());

        if($this->docenteRepo->update($id_docente,$request)){
            $mensaje='Informacion Actualizada con Exito!!!';
			Flash::info($mensaje);
        }else{
            $mensaje='No se realizo ningun cambio en la informacion para actualizar!!!';
			Flash::error($mensaje);
        }

		if(\Auth::user()->id==$id_docente){
			$url='/home';
		}else{
			$url='/escuela/docentes';
		}
        return redirect(url($url));

		//return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)	{

		$this->docenteRepo->delete($id);
		$mensaje='Registro eliminado con Exito!!!';
		Flash::info($mensaje);
		return redirect('/escuela/docentes');
	}

}
