<?php
namespace cteles\Repositorios;


use cteles\Models\Turno;

class TurnoRepo{

    public function all(){
        $turno=Turno::all();

        return $turno;
    }

}