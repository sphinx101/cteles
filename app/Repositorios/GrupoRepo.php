<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21/09/2016
 * Time: 03:54 PM
 */

namespace cteles\Repositorios;


use cteles\Models\Grupo;

class GrupoRepo{

    public function all(){
        $grupo=Grupo::all();

        return $grupo;
    }
}