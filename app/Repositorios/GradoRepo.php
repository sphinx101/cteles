<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21/09/2016
 * Time: 03:54 PM
 */

namespace cteles\Repositorios;


use cteles\Models\Grado;

class GradoRepo{

    public function all(){
        $grado=Grado::all();

        return $grado;
    }
}