<?php

use Illuminate\Database\Seeder;



class GradosTableSeeder extends Seeder
{
    public function run(){
        DB::table('grados')->insert(array(
           'nom_grado'=>'PRIMERO'
        ));
        DB::table('grados')->insert(array(
            'nom_grado'=>'SEGUNDO'
        ));
        DB::table('grados')->insert(array(
            'nom_grado'=>'TERCERO'
        ));
    }
}
