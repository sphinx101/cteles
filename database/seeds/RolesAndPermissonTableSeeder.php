<?php


use cteles\Models\Permission;
use cteles\Models\Role;
use cteles\User;
use Illuminate\Database\Seeder;



class RolesAndPermisson extends Seeder{

    public function run() {
        $admin=new Role();
        $admin->name='admin';
        $admin->display_name='administrador del sistema';
        $admin->description='gestiona y mantiene el sistema';
        $admin->save();

        $supervisor=new Role();
        $supervisor->name='supervisor';
        $supervisor->display_name='supervisor de los directores';
        $supervisor->description='responsable del control de los directores';
        $supervisor->save();

        $director=new Role();
        $director->name='director';
        $director->display_name='director del centro de trabajo';
        $director->description='responsable del centro de trabajo';
        $director->save();

        $docente=new Role();
        $docente->name='docente';
        $docente->display_name='docente del centro de trabajo';
        $docente->description='responsable de alumnos a su cargo';
        $docente->save();

        /*$user= User::find(1);
        $user->attachRole($admin);
        $user= User::find(3);
        $user->attachRole($director);
        $user= User::find(10);
        $user->attachRole($docente);*/


        $controlUser=new Permission();
        $controlUser->name='control-total'; //'control-usuarios'
        $controlUser->display_name='Permiso  Total del Sistema';
        $controlUser->description='Agrega, Edita, Elimina, Mantiene registros del sistema';
        $controlUser->save();

        $controlDirector=new Permission();
        $controlDirector->name='control-director';
        $controlDirector->display_name='Control Directores';
        $controlDirector->description='Agrega, Edita, Elimina a usuarios directores';
        $controlDirector->save();

        $controlDocente=new Permission();
        $controlDocente->name='control-docente';
        $controlDocente->display_name='Control Docentes';
        $controlDocente->description='Agrega, Edita, Elimina a usuarios docentes del Centro de Trabajo correspondiente';
        $controlDocente->save();

        $controlAlumno=new Permission();
        $controlAlumno->name='control-alumnos';
        $controlAlumno->display_name='Control Alumnos';
        $controlAlumno->description='Agrega, Edita, Elimina a alumnos bajo su cargo en el Centro de Trabajo';
        $controlAlumno->save();



        $admin->attachPermissions([$controlUser,$controlDirector,$controlDocente,$controlAlumno]);
        $supervisor->attachPermissions([$controlDirector,$controlDocente]);
        $director->attachPermissions([$controlDocente,$controlAlumno]);
        $docente->attachPermission($controlAlumno);

    }
}
