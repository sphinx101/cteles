<?php

namespace cteles\Repositorios;


use cteles\Models\Alumno;
use cteles\Models\Centrotrabajo;
use cteles\User;

class AlumnoRepo{


    public function all(){
        $alumnos=null;
        $ct=$this->findCentroTrabajoByUser(\Auth::user()->id);

        $alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
                 ->leftjoin('padretutores as pt','pt.alumno_id','=','alumnos.id')
                 ->where('ct.id','=',$ct->id)
                 ->orderby('alumnos.id')
                 ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor');

        return $alumnos->paginate(10);

    }

    public function retrieveAlumnoCT($centrotrabajo_id){}


    public function store($data){

        return Alumno::create($data->all());
    }

    public function update($alumno_id){}

    public function delete($alumno_id){}



    public function retrieveAlumnoByCurp($curp){
        //dd($curp);
        $ct=$this->findCentroTrabajoByUser(\Auth::user()->id);
        $alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
            ->leftjoin('padretutores as pt','pt.alumno_id','=','alumnos.id')
            ->where('ct.id','=',$ct->id)
            ->where('alumnos.curp','LIKE','%'.$curp.'%')
            ->orderby('alumnos.id')
            ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor');

        return $alumnos->paginate(10);
    }

    public function findCentroTrabajoByUser($user_id){
        $user=User::find($user_id);
        $docente=$user->docente;
        $ct=Centrotrabajo::find($docente->centrotrabajo_id);

        return $ct;
    }



}