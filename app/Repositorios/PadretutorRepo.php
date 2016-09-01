<?php
namespace cteles\Repositorios;


use cteles\Models\Centrotrabajo;
use cteles\Models\Docente;
use cteles\Models\Padretutor;
use cteles\User;
use Illuminate\Support\Collection;

class PadretutorRepo{

    public function all(){

        $docente=$this->findDocenteByUserId(\Auth::user()->id);
        $ct_id=Centrotrabajo::find($docente->centrotrabajo_id)->id;
        $alumnos=Centrotrabajo::find($ct_id)->alumnos;
        $tutores=array();
        foreach($alumnos as $alumno){
            foreach($alumno->padretutores as $tutor){
               $tutores[$tutor->id]=$tutor;
            }
        }
        return Collection::make($tutores);


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