<?php

use Illuminate\Database\Seeder;



class CicloescolarTableSeeder extends Seeder
{
    public function run(){
        for($i=1;$i<10;$i++) {
            DB::table('cicloescolares')->insert(array(
                'ciclo' => '20'.($i+15).'-20'.($i+16)
            ));
        }
    }
}
