<?php
namespace cteles\Repositorios;


use cteles\Models\Alumno;
use cteles\Models\Centrotrabajo;
use cteles\Models\Docente;
use cteles\Models\Padretutor;
use cteles\Models\Parentesco;
use cteles\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PadretutorRepo{

    //TODO: falta implemenar las acciones de agregar, editar y eliminar para el ROL de usuario DOCENTE


    public function all(){

        $docente=$this->findDocenteByUserId(\Auth::user()->id);
        $ct_id=Centrotrabajo::find($docente->centrotrabajo_id)->id;
        //$alumnos=Centrotrabajo::find($ct_id)->alumnos;
        $centrotrabajo=Centrotrabajo::find($ct_id);
        //$tutores=array();

        /*foreach($alumnos as $alumno){
            foreach($alumno->padretutores as $tutor){
               $tutores[$tutor->id]=$tutor;
            }
        }*/

       /* $ts=new Collection($tutores);
        $ts=$ts->sortBy(function($item){
            return $item->id;
        });*/

        $ts=Padretutor::whereHas('alumnos',function($query) use($ct_id){
             $query->where('alumnos.centrotrabajo_id','=',$ct_id);
        })->get();
        $currentPage=LengthAwarePaginator::resolveCurrentPage()==null ? 1 : LengthAwarePaginator::resolveCurrentPage();
        $perPage=5;
        $currentPageSearchResult=$ts->slice(($currentPage-1)*$perPage,$perPage)->all();

        $paginador=new LengthAwarePaginator($currentPageSearchResult,count($ts),$perPage,$currentPage,['path'=>LengthAwarePaginator::resolveCurrentPath()]);

        $paginaciontotal=[
               'paginador'=>$paginador,
               'total_registros'=>$ts->count(),
               'centrotrabajo' => $centrotrabajo->cct.' '.$centrotrabajo->nombre,
        ];

        return $paginaciontotal;



    }

    public function show($tutor_id,Request $request){
        $tutor=Alumno::find($request->get('alumno_id'))->padretutores()->find($tutor_id);
        return $tutor;
    }


    public function findDocenteByUserId($user_id){
        $user=User::find($user_id);

        return $user->docente;
    }
    public function findTutorParentescoById($parentesco_id){
        return Parentesco::find($parentesco_id);
    }

    /**
     * Metodo el cual verifica que exista una relacion tutor-alumno
     * @param $alumno_id
     * @param $padretutor_id
     * @return bool
     */
    public function checkRelationTutorAlumno($alumno_id,$padretutor_id){
        $check=true;
        $centrotrabajo_id= $docente=$this->findDocenteByUserId(\Auth::user()->id)->centrotrabajo_id;
        $tutor=Padretutor::whereHas('alumnos',function($query) use($centrotrabajo_id,$alumno_id,$padretutor_id){
               $query->where('alumnos.centrotrabajo_id','=',$centrotrabajo_id)->where('alumnos.id','=',$alumno_id)->where('padretutores.id','=',$padretutor_id);
        })->get();
        if($tutor->count()==0)
            $check=false;
        return $check;
    }
    public function searchTutores($nombre,$paterno){

        $docente=$this->findDocenteByUserId(\Auth::user()->id);
        $ct_id=Centrotrabajo::find($docente->centrotrabajo_id)->id;
        $centrotrabajo=Centrotrabajo::find($ct_id);
        $ts=Padretutor::whereHas('alumnos',function($query)use($ct_id) {
            $query->where('alumnos.centrotrabajo_id', '=', $ct_id);
        })->whereHas('alumnos',function($query)use($nombre){
                  $query->where('padretutores.nombre','like','%'.$nombre.'%');
        })->OrWhereHas('alumnos',function($query)use($paterno){
                  $query->where('padretutores.appaterno','like','%'.$paterno.'%');
        })->paginate(5);

        $paginaciontotal=[
             'paginador'=>$ts,
             'total_registros'=>$ts->count(),
             'centrotrabajo'=>$centrotrabajo->cct.' '.$centrotrabajo->nombre,
        ];
        return $paginaciontotal;
    }
}