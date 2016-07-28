<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="material-icons">group</i><span> Docente</span> <b class="caret"></b>
    </a>

    <ul class="dropdown-menu">


        <li><a href="{{route('escuela.docentes.index')}}"><i class="material-icons">sort_by_alpha</i><span>&nbsp;Listar Docente Datos Generales</span></a></li>

        @if(Entrust::hasRole('director') || Entrust::hasRole('admin'))
            <li><a href="{{route('escuela.docentes.index')}}"><i class="material-icons">sort_by_alpha</i><span>&nbsp;Listar Docente Aula Asignada</span></a></li>
            <li><a href="#"><i class="material-icons">local_library</i><span>&nbsp;Asignar Aula-Alumno</span></a></li>

        @endif
        @if(Entrust::hasRole('supervisor') || Entrust::hasRole('admin') )
            @include('partials.menuadmin')
        @endif
    </ul>
</li>
@if(Entrust::hasRole('director'))
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">folder_shared</i><span> Inscripcion</span> <b class="caret"></b>
        </a>

        <ul class="dropdown-menu">


            <li><a href="{{route('escuela.alumnos.create')}}"><i class="material-icons">group_add</i><span>&nbsp;PreInscribir Alumno Primer Grado</span></a></li>
            <li><a href=""><i class="material-icons">school</i><span>&nbsp;Inscribir Alumno Ciclo Escolar</span></a></li>


        </ul>
    </li>


@endif

