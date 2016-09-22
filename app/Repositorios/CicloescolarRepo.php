<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 21/09/2016
 * Time: 03:55 PM
 */

namespace cteles\Repositorios;


use cteles\Models\Cicloescolar;

class CicloescolarRepo{

    public function all(){
        $ciclo=Cicloescolar::all();

        return $ciclo;
    }

    public function CicloEscolarActual(){
        return 1;
    }
}