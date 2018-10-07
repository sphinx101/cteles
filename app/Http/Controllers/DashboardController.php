<?php

namespace cteles\Http\Controllers;



use cteles\Models\Centrotrabajo;
use cteles\Repositorios\DocenteRepo;

use cteles\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller{


    private $docenteRepo;

    public function __construct(DocenteRepo $docenteRepo){
        $this->docenteRepo=$docenteRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $ct_id = User::find(\Auth::user()->id)->docente->centrotrabajo_id;
        $cct_completo = Centrotrabajo::find($ct_id)->nombre_completo;
        $docente=ucwords($this->docenteRepo->findDocenteByUserId(\Auth::user()->id)->nombre_completo);
        $rol=User::find(\Auth::user()->id)->roles[0]->name;
        $user=\Auth::user()->username;

        return view('app2', compact('docente','cct_completo','rol','user'));
    }


}
