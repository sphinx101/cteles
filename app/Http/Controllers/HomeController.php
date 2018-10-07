<?php namespace cteles\Http\Controllers;


use cteles\Repositorios\DocenteRepo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    /**
     * @var DocenteRepo
     */
    private $docenteRepo;

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(DocenteRepo $docenteRepo){
		//$this->middleware('auth');

        $this->docenteRepo = $docenteRepo;
    }

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()	{
       $existDocente=$this->docenteRepo->existsDatosRegistrados(\Auth::user()->id);
        //dd(\Auth::user()->type);
       if(!$existDocente){
           Flash::error('Debe de Registrar sus datos personales (Centro de Trabajo,RFC,CURP,Nombre Completo,Celular,Telefono) en la opcion -Registrar Datos');
       }

       return view('home'); //home
	}
    //Verifica via ajax que los datos del docente(usuario) esten registrados
    public function exist(){
        $existDocente=$this->docenteRepo->existsDatosRegistrados(\Auth::user()->id);
        return Response::json(array('success'=>true,'existe'=>$existDocente));
    }

}
