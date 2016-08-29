<?php

namespace cteles\Repositorios;


use cteles\Http\Requests\EditAlumnoRequest;
use cteles\Models\Alumno;
use cteles\Models\Centrotrabajo;
use cteles\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class AlumnoRepo{


    /**
     * @return mixed
     */
    public function all(){

        $ct=$this->findCentroTrabajoByUser(\Auth::user()->id);

        /*$alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
                 ->leftjoin('padretutores as pt','pt.alumno_id','=','alumnos.id')
                 ->where('ct.id','=',$ct->id)
                 ->orderby('alumnos.id')
                 ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor');*/
        /*$alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
                ->leftjoin('alumno_padretutor as t','t.alumno_id','=','alumnos.id')
                ->leftjoin('padretutores as pt','pt.id','=','t.padretutor_id')
                ->where('ct.id','=',$ct->id)
                ->orderby('alumnos.id')
                ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor')->get();*/

        $alumnos=Alumno::with('padretutores')->where('centrotrabajo_id','=',$ct->id);


        return $alumnos->paginate(5);

    }

    public function retrieveAlumnoCT($centrotrabajo_id){}


    /**
     * @param $data
     * @return boolean
     */
    public function store($data){

        return Alumno::create($data->all());
    }

    /**
     * @param $alumno_id
     * @param EditAlumnoRequest $request
     * @return json
     */
    public function update($alumno_id, EditAlumnoRequest $request){
        $OK_HTTP=200;
        $FAIL_HTTP=422;
        $ISUPDATE=100;
        $NOUPDATE=101;

        $http_respuesta=0;

        $alumno=Alumno::find($alumno_id);

        try{
            $alumno_temp=Alumno::where('curp',$request->get('curp'))->firstOrFail();
            if($alumno_id==$alumno_temp->id){
                if($this->changeFieldValueAlumno($alumno,$request)){
                    $modificado=$ISUPDATE;
                    $alumno->save();
                }else{
                    $modificado=$NOUPDATE;
                }
                $http_respuesta=$OK_HTTP;
                //return $this->changeFieldValueAlumno($alumno, $request) ? $alumno->save() : false;
            }else{
                $http_respuesta=$FAIL_HTTP;
                $modificado=$NOUPDATE;
            }
        }catch (ModelNotFoundException $e){
            if($this->changeFieldValueAlumno($alumno,$request)){
                $modificado=$ISUPDATE;
                $alumno->save();
            }
            $http_respuesta=$OK_HTTP;
        }


        $respuesta= [
            'modificado'=>$modificado,
            'http_respuesta'=>$http_respuesta
        ];
        return $respuesta;

       // return $this->changeFieldValueAlumno($alumno, $request) ? $alumno->save() : false;

    }


    /**
     * @param $alumno_id
     * @return mixed
     */
    public function delete($alumno_id){
        $alumno=Alumno::find($alumno_id);

        if(count($alumno->padretutores)>0) {
            foreach ($alumno->padretutores as $tutor) {
                $tutores_ids[] = $tutor->id;
            }
            $alumno->padretutores()->detach($tutores_ids); //Eliminar los registros relacionales entre alumno y padretutores
        }

        return $alumno->delete();

    }


    /**
     * @param $id
     * @return Model Alumno
     */
    public function retrieveAlumnoTutor($id){
        $alumnos=null;
        $ct=$this->findCentroTrabajoByUser(\Auth::user()->id);

        /*$alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
            ->leftjoin('padretutores as pt','pt.alumno_id','=','alumnos.id')
            ->where('ct.id','=',$ct->id)
            ->where('alumnos.id','=',$id)
            ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor')->first();*/
       /* $alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
            ->leftjoin('alumno_padretutor as t','t.alumno_id','=','alumnos.id')
            ->leftjoin('padretutores as pt','pt.id','=','t.padretutor_id')
            ->where('ct.id','=',$ct->id)
            ->where('alumnos.id','=',$id)
            ->orderby('alumnos.id')
            ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor')->first();*/

        $alumnos=Alumno::with('padretutores')->where('centrotrabajo_id','=',$ct->id)->where('alumnos.id','=',$id)->first();
        return $alumnos;
    }

    /**
     * @param $alumno_id
     * @return Model Alumno
     */
    public function findAlumnoById($alumno_id){
        //dd(Alumno::find($alumno_id));
        return Alumno::find($alumno_id);
    }

    /**
     * @param $curp
     * @return Collection Alumno
     */
    public function retrieveAlumnoByCurp($curp){
        //dd($curp);
        $ct=$this->findCentroTrabajoByUser(\Auth::user()->id);
        /*$alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
            ->leftjoin('padretutores as pt','pt.alumno_id','=','alumnos.id')
            ->where('ct.id','=',$ct->id)
            ->where('alumnos.curp','LIKE','%'.$curp.'%')
            ->orderby('alumnos.id')
            ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor');*/
       /* $alumnos=Alumno::join('centrotrabajos as ct','ct.id','=','alumnos.centrotrabajo_id')
            ->leftjoin('alumno_padretutor as t','t.alumno_id','=','alumnos.id')
            ->leftjoin('padretutores as pt','pt.id','=','t.padretutor_id')
            ->where('ct.id','=',$ct->id)
            ->where ('alumnos.curp','LIKE','%'.$curp.'%')
            ->orderby('alumnos.id')
            ->select('alumnos.*','pt.nombre as nombretutor','pt.appaterno as aptutor','pt.apmaterno as amtutor');*/

        $alumnos=Alumno::with('padretutores')->where('centrotrabajo_id','=',$ct->id)->where('alumnos.curp','LIKE','%'.$curp.'%');
        return $alumnos->paginate(5);
    }

    /**
     * @param $user_id
     * @return Model Centrotrabajo
     */
    public function findCentroTrabajoByUser($user_id){
        $user=User::find($user_id);
        $docente=$user->docente;
        $ct=Centrotrabajo::find($docente->centrotrabajo_id);

        return $ct;
    }


    //*********************** Metodos Auxiliares **********************

    /**
     * @param Alumno $alumnoOriginal
     * @param EditAlumnoRequest $request
     * @return bool
     */
    private function changeFieldValueAlumno(Alumno $alumnoOriginal, EditAlumnoRequest $request){
        $isModified=false;

        if($alumnoOriginal->curp!==$request->get('curp')){
            $isModified=true;
            $alumnoOriginal->curp=$request->get('curp');
        }
        if($alumnoOriginal->nombre!==$request->get('nombre')){
            $isModified=true;
            $alumnoOriginal->nombre=$request->get('nombre');
        }
        if($alumnoOriginal->appaterno!==$request->get('appaterno')){
            $isModified=true;
            $alumnoOriginal->appaterno=$request->get('appaterno');
        }
        if($alumnoOriginal->apmaterno!==$request->get('apmaterno')){
            $isModified=true;
            $alumnoOriginal->apmaterno=$request->get('apmaterno');
        }
        if($alumnoOriginal->localidad!==$request->get('localidad')){
            $isModified=true;
            $alumnoOriginal->localidad=$request->get('localidad');
        }
        if($alumnoOriginal->domicilio!==$request->get('domicilio')){
            $isModified=true;
            $alumnoOriginal->domicilio=$request->get('domicilio');
        }

        return $isModified;
    }



}