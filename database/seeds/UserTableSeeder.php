<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;


class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){


		$faker=Faker::create('es_ES');
		for ($i=0; $i <80 ; $i++) {
			
		
			$id=\DB::table('users')->insertGetId(array(
				 'username'=>$faker->userName,
				 'email'=>$faker->unique()->email,
				 'password'=>\Hash::make('123456'),
				 'type'=>$faker->randomElement($array = array ('admin','supervisor','docente','director'))

			));

			\DB::table('docentes')->insert(array(
				 'centrotrabajo_id'=>$faker->randomElement($array=array(1,2)),
				 'user_id'=>$id,
				 'rfc'=>$faker->unique()->isbn13,
				 'curp'=>$faker->unique()->ean13,
				 'nombre'=>$faker->firstName,
				 'appaterno'=>$faker->lastName,
				 'apmaterno'=>$faker->lastName,
				 'celular'=>$faker->phoneNumber,
				 'telefono'=>$faker->phoneNumber,
				 'actualizado'=>'1'

			));



		}


		
	}

}
