<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AlumnoTableSeeder extends Seeder
{
    public function run() {

        $faker=Faker::create('es_ES');

        for($i=0;$i<150;$i++){
            DB::table('alumnos')->insert(array(
                'centrotrabajo_id'=>$faker->randomElement(['1','2']),
                'curp'=>$faker->unique()->ean8.$faker->isbn10,
                'nombre'=>$faker->firstName,
                'appaterno'=>$faker->lastName,
                'apmaterno'=>$faker->lastName,
                'localidad'=>$faker->city,
                'domicilio'=>$faker->address

            ));
        }
    }
}
