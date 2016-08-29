<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateDbCteles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centrotrabajos', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('cct')->unique();
		    $table->string('nombre');

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('docentes', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('centrotrabajo_id')->unsigned();
		    $table->foreign('centrotrabajo_id')->references('id')->on('centrotrabajos')->onDelete('cascade')->onUpdate('cascade');
		    $table->integer('user_id')->unsigned();
		    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		    $table->string('rfc',15)->unique();
		    $table->string('curp',20)->unique();
            $table->string('nombre');
		    $table->string('appaterno');
            $table->string('apmaterno');
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
			$table->boolean('actualizado')->default(false);

            $table->timestamps();
            $table->softDeletes();
		});

		Schema::create('cicloescolares', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('ciclo',45)->unique();

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('turnos', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('nom_turno',20)->unique();

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('grupos', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('nom_grupo',3)->unique();

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('grados', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('nom_grado',10)->unique();

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('alumnos', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('centrotrabajo_id')->unsigned();
		    $table->foreign('centrotrabajo_id')->references('id')->on('centrotrabajos')->onUpdate('cascade');
			$table->string('curp',20)->unique();
			$table->string('nombre',20);
			$table->string('appaterno',20);
			$table->string('apmaterno',20);
			$table->string('localidad',50);
			$table->string('domicilio');
			

			$table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('aulas', function(Blueprint $table)
		{
			$table->increments('id');
			// $table->integer('alumno_id')->unsigned();
			// $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade');  // relacion alumno-aula
			$table->integer('docente_id')->unsigned();
			$table->foreign('docente_id')->references('id')->on('docentes')->onUpdate('cascade'); //relacion docente-aula
			$table->integer('turno_id')->unsigned();
            $table->foreign('turno_id')->references('id')->on('turnos')->onUpdate('cascade'); //relacion turno-aula
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos')->onUpdate('cascade'); //relacion grupo-aula
            $table->integer('grado_id')->unsigned();
            $table->foreign('grado_id')->references('id')->on('grados')->onUpdate('cascade'); // relacion grado-aula
			$table->integer('cicloescolar_id')->unsigned();
			$table->foreign('cicloescolar_id')->references('id')->on('cicloescolares')->onUpdate('cascade'); // relacion ciclo-aula
			//$table->integer('inscripcion_id')->unsigned();
			//$table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onUpdate('cascade');  // relacion inscripcion-aula

			$table->timestamps();
			$table->softDeletes();

		});

		Schema::create('inscripciones',function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alumno_id')->unsigned();
			$table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade'); // relacion alumno-inscripcion
			$table->integer('aula_id')->unsigned();
			$table->foreign('aula_id')->references('id')->on('aulas')->onUpdate('cascade');  // relacion aula-inscripcion
			//$table->integer('cicloescolar_id')->unsigned();
			//$table->foreign('cicloescolar_id')->references('id')->on('cicloescolares')->onUpdate('cascade');  // relacion ciclo-inscripcion
			//$table->integer('turno_id')->unsigned();
			//$table->foreign('turno_id')->references('id')->on('turnos')->onUpdate('cascade'); //relacion turno-inscripcion
			//$table->integer('grupo_id')->unsigned();
			//$table->foreign('grupo_id')->references('id')->on('grupos')->onUpdate('cascade'); //relacion grupo-inscripcion
			//$table->integer('grado_id')->unsigned();
			//$table->foreign('grado_id')->references('id')->on('grados')->onUpdate('cascade'); // relacion grado-inscripcion


			$table->timestamps();
			$table->softDeletes();
		});



		Schema::create('asistencias', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('alumno_id')->unsigned();
		    $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade'); //relacion alumno-asistencia
		    $table->dateTime('fecha');
		    $table->boolean('asistio')->default(true);

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('padretutores', function(Blueprint $table)
		{
		    $table->increments('id');
		   // $table->integer('alumno_id')->unsigned();
		   // $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade'); //relacion alumno-padrestutores
			$table->string('nombre',20);		    
			$table->string('appaterno',20);		    
			$table->string('apmaterno',20);
			$table->string('telefono')->nullable();
			$table->string('celular')->nullable();
			$table->enum('parentesco',['PAPA','MAMA','HERMANOS','TIOS','PRIMOS','ABUELOS','CONOCIDOS']);
			$table->string('domicilio',200)->nullable();
			$table->string('localidad',30)->nullable();
			$table->string('ocupacion',30)->nullable();
			$table->string('escolaridad',15)->nullable();
			
			$table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('materias', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('nom_materia',30);

		    $table->timestamps();
		    $table->softDeletes();
		
		});

		Schema::create('bloques', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->string('nom_bloque',15);

		    $table->timestamps();
		    $table->softDeletes();
		
		});


		Schema::create('calificaciones', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->integer('alumno_id')->unsigned();
		    $table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade'); //relacion alumno-calificaciones
			$table->integer('materia_id')->unsigned();
		    $table->foreign('materia_id')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade'); //relacion alumno-maeria
		    $table->integer('bloque_id')->unsigned();
		    $table->foreign('bloque_id')->references('id')->on('bloques')->onUpdate('cascade')->onDelete('cascade'); //relacion alumno-bloque
		    $table->double('examen1', 2, 1);
		    $table->double('examen2', 2, 1);
		    $table->double('examen3', 2, 1);
		    $table->double('prom_examen', 2, 1);

			$table->timestamps();
			$table->softDeletes();
		});
		Schema::create('alumno_padretutor', function(Blueprint $table)      // tabla pivote alumnos-padretutores
		{

			$table->integer('alumno_id')->unsigned();
			$table->foreign('alumno_id')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('padretutor_id')->unsigned();
			$table->foreign('padretutor_id')->references('id')->on('padretutores')->onUpdate('cascade')->onDelete('cascade');
			$table->timestamps();
		});






	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alumno_padretutor');
		Schema::drop('calificaciones');
		Schema::drop('padretutores');
		Schema::drop('asistencias');
		Schema::drop('inscripciones');
		Schema::drop('aulas');
		Schema::drop('docentes');
		Schema::drop('cicloescolares');
		Schema::drop('turnos');
		Schema::drop('grupos');
		Schema::drop('grados');
		Schema::drop('materias');
		Schema::drop('bloques');
		Schema::drop('alumnos');
		Schema::drop('centrotrabajos');
		
	}

}
