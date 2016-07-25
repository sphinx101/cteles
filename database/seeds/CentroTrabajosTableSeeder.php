<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class CentroTrabajosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		

		$faker=Faker::create('es_ES');
		for ($i=0; $i <5 ; $i++) { 
			
		
			\DB::table('centrotrabajos')->insert(array(
						 'cct'=>$faker->unique()->postcode,
						 'nombre'=>$faker->city
				 

			));
		}

		
	}

}
