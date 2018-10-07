<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PadretutoresTableSeeder extends Seeder
{
    public function run()
    {
        $faker=Faker::create('es_ES');
        for($i=0;$i<120;$i++){
            DB::table('padretutores')->insert(array(


                'nombre'=>$faker->firstName,
                'appaterno'=>$faker->lastName,
                'apmaterno'=>$faker->lastName,
                'localidad'=>$faker->city,
                'domicilio'=>$faker->address,


            ));
        }
    }
}
