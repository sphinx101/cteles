<?php

namespace cteles\Repositorios;


use cteles\Models\Aula;

class AulaRepo{

    /**
     * @param $ct_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($ct_id){
        $aulas=Aula::with('docente','turno','grupo','grado','cicloescolar')
                   ->whereHas('docente.user',function($query)use($ct_id){
                        $query->where('centrotrabajo_id',$ct_id)
                              ->where('type','=','docente');
                   })->paginate(4);
        return $aulas;
    }

    /**
     * @param $data
     * @return boolean
     */
    public function store($data){
       return Aula::create($data->all());
    }

    /**
     * @param $aula_id
     * @return bool
     */
    public function delete($aula_id){
        $aula=Aula::find($aula_id);
        if($aula!=null)
           return $aula->delete();
        else
           return false;
    }

}