<?php

namespace cteles\Repositorios;


use cteles\Models\Centrotrabajo;
use Illuminate\Support\Facades\Schema;

class CentrotrabajoRepo{

    public function all(){

        $rs=Centrotrabajo::all();
        $datos=array();
        $i=0;
        foreach($rs as $r){
            $datos[$i]['id']=$r->id;
            $datos[$i]['cct']=$r->cct;
            $datos[$i]['nombre']=$r->nombre;
            $i++;
        }
        return $datos;
    }
    public function listCCT(){
        return  Centrotrabajo::lists('cct','id');
    }

    public function findByCentrotrabajoById($id){
        return Centrotrabajo::find($id);
    }


    public function search($input){
        $query = Centrotrabajo::query();

        $columns = Schema::getColumnListing('centrotrabajos');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute])){
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query->get(), $attributes];

    }

}