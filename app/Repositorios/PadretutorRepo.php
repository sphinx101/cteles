<?php
namespace cteles\Repositorios;


use cteles\Models\Centrotrabajo;
use cteles\Models\Docente;
use cteles\Models\Padretutor;
use cteles\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PadretutorRepo{

    public function all(){

        $docente=$this->findDocenteByUserId(\Auth::user()->id);
        $ct_id=Centrotrabajo::find($docente->centrotrabajo_id)->id;
        $alumnos=Centrotrabajo::find($ct_id)->alumnos;
        $centrotrabajo=Centrotrabajo::find($ct_id);
        $tutores=array();

        foreach($alumnos as $alumno){
            foreach($alumno->padretutores as $tutor){
               $tutores[$tutor->id]=$tutor;
            }
        }
        //ksort($tutores,SORT_REGULAR);
        $ts=new Collection($tutores);
        $ts=$ts->sortBy(function($item){
            return $item->id;
        });
        $currentPage=LengthAwarePaginator::resolveCurrentPage()==null ? 1 : LengthAwarePaginator::resolveCurrentPage();
        $perPage=5;
        $currentPageSearchResult=$ts->slice(($currentPage-1)*$perPage,$perPage)->all();
        //$currentPageSearchResult=array_slice($tutores,($currentPage-1)*$perPage,$perPage);
        $paginador=new LengthAwarePaginator($currentPageSearchResult,count($ts),$perPage,$currentPage,['path'=>LengthAwarePaginator::resolveCurrentPath()]);

        $paginaciontotal=[
               'paginador'=>$paginador,
               'total_registros'=>count($tutores),
               'centrotrabajo' => $centrotrabajo->cct.' '.$centrotrabajo->nombre,
        ];

        return $paginaciontotal;



    }

    public function show($tutor_id){
        $tutor=Padretutor::find($tutor_id);
        return $tutor;
    }
    public function findDocenteByUserId($user_id){
        $user=User::find($user_id);

        return $user->docente;
    }
}