<?php

use Illuminate\Database\Seeder;



class GruposTableSeeder extends Seeder
{
    public function run(){
        DB::table('grupos')->insert(array(
          'nom_grupo'=>'A'
        ));
        DB::table('grupos')->insert(array(
            'nom_grupo'=>'B'
        ));
        DB::table('grupos')->insert(array(
            'nom_grupo'=>'C'
        ));
    }
}
