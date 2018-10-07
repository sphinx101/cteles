<?php

use Illuminate\Database\Seeder;



class ParentescoTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('parentescos')->insert(array(
            'tipo'=>'PAPA',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'MAMA',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'TIO(A)',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'HERMANO(A)',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'ABUELO(A)',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'PRIMO(A)',
        ));
        DB::table('parentescos')->insert(array(
            'tipo'=>'CONOCIDO(A)',
        ));
    }
}
