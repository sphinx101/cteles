<?php

namespace cteles\Repositorios;


use cteles\Models\Alumno;

class AlumnoRepo{


    public function all(){

    }

    public function retrieveAlumnoCT($centrotrabajo_id){}


    public function store($data){

        return Alumno::create($data->all());
    }

    public function update($alumno_id){}

    public function delete($alumno_id){}



}