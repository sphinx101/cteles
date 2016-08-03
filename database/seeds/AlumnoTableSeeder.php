<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AlumnoTableSeeder extends Seeder
{
    public function run() {

        $faker=Faker::create('es_ES');

        for($i=0;$i<50;$i++){
            DB::table('alumnos')->insert(array(
                'centrotrabajo_id'=>2,
                'curp'=>$faker->unique()->ean13,
                'nombre'=>$faker->firstName,
                'appaterno'=>$faker->lastName,
                'apmaterno'=>$faker->lastName,
                'localidad'=>$faker->city,
                'domicilio'=>$faker->address

            ));
        }
    }
}
