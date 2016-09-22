<?php

use Illuminate\Database\Seeder;



class TurnosTableSeeder extends Seeder
{
    public function run(){

        DB::table('turnos')->insert(array(
            'nom_turno' => 'MATUTINO'
        ));
        DB::table('turnos')->insert(array(
            'nom_turno' => 'VESPERTINO'
        ));

    }
}
