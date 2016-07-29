<?php


namespace cteles\Repositorios;


use cteles\Http\Requests\EditDocenteRequest;
use cteles\Models\Centrotrabajo;
use cteles\Models\Docente;
use cteles\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DocenteRepo{

    public $isModified=false;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(){
        $docentes=null;
        if(\Auth::user()->type=='director'){

            /*TODO Verificar que existe el usuario autenticado en la tabla docentes*/

            $docente=$this->findDocenteByUserId(\Auth::user()->id);
            $ct_id=Centrotrabajo::find($docente->first()->centrotrabajo_id)->id;


            $docentes=Docente::join('centrotrabajos as ct','ct.id','=','docentes.centrotrabajo_id')
                      ->join('users as u','u.id','=','docentes.user_id')
                      ->where('ct.id','=',$ct_id)
                      ->where('u.type','=','docente')
                      ->select('docentes.*');
            //dd($docentes);

        }else if(\Auth::user()->type=='admin' || \Auth::user()->type=='supervisor'){
            $docentes=Docente::AllDocentesForAdmin(\Auth::user()->id);

        }
        //dd($docentes);
        return $docentes->paginate(10);

    }



    /**
     * @param $id
     * @return Docente
     */
    public function findDocenteById($id){
        return Docente::find($id);
    }

    /**
     * @param $user_id
     * @return Docente
     */
    public function findDocenteByUserId($user_id){
        $user=User::find($user_id);
        return $user->docente;
    }


    public function existsDatosRegistrados($user_id){
       $exist=false;
       $user=User::find($user_id);

       if($user->docente!=null){
           $exist=true;
       }else{
           $exist=false;
       }

       return $exist;
    }

    public function store($data){

      //dd($data->all());
      return Docente::create($data->all());
    }

    /**
     * @param $id_docente
     * @param EditDocenteRequest $request
     * @return bool
     *
     */
    public function update($id_docente,EditDocenteRequest $request){

        $docente=Docente::find($id_docente);
        //dd($docente->user_id);
        if($this->changeValueFieldDocente($docente,$request)) {
            $docente->actualizado = $request['actualizado'];
            $docente->user_id = $id_docente;
            return $docente->save();
        }else{
            return false;
        }

    }

    /**
     * @param $id
     */
    public function delete($id){
        $docente=Docente::find($id);

        return $docente->user->delete();
        //return $docente->delete();
    }


    //************************* metodos auxiliares *************************
    /**
     * @param Docente $docenteOriginal
     * @param EditDocenteRequest $request
     * @return boolean
     */
    private  function changeValueFieldDocente(Docente $docenteOriginal,EditDocenteRequest $request){
        $isModified=false;

        if($docenteOriginal->centrotrabajo_id!=$request->get('centrotrabajo_id')){
            $isModified=true;
            $docenteOriginal->centrotrabajo_id=$request['centrotrabajo_id'];

        }
        if($docenteOriginal->rfc!=$request->get('rfc')){
            $isModified=true;
            $docenteOriginal->rfc=$request['rfc'];

        }
        if($docenteOriginal->curp!=$request->get('curp')){
            $isModified=true;
            $docenteOriginal->curp=$request['curp'];
        }
        if($docenteOriginal->nombre!=$request->get('nombre')){
            $isModified=true;
            $docenteOriginal->nombre=$request['nombre'];
        }
        if($docenteOriginal->appaterno!=$request->get('appaterno')){
            $isModified=true;
            $docenteOriginal->appaterno=$request['appaterno'];
        }
        if($docenteOriginal->apmaterno!=$request->get('apmaterno')){
            $isModified=true;
            $docenteOriginal->apmaterno=$request['apmaterno'];
        }
        if($docenteOriginal->celular!=$request->get('celular')){
            $isModified=true;
             $docenteOriginal->celular=$request['celular'];
        }
        if($docenteOriginal->telefono!=$request->get('telefono')){
            $isModified=true;
            $docenteOriginal->telefono=$request['telefono'];

        }
        return $isModified;

    }

}