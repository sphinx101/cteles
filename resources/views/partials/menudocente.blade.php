<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="material-icons">school</i><span> Alumno</span> <b class="caret"></b>
    </a>

    <ul class="dropdown-menu">

        @if(Entrust::hasRole('docente'))
            <li><a href="#"><i class="material-icons">sort_by_alpha</i><span>&nbsp;Listar</span></a></li>
            <li><a href="#"><i class="material-icons">spellcheck</i><span>&nbsp;Asistencia</span></a></li>
            <li role="separator" class="divider"></li>
            <li><a href=""><i class="material-icons">exposure_plus_1</i><span>&nbsp;Registrar Calificaciones</span></a></li>
        @endif



        @if(Entrust::hasRole('docente'))

        @endif

        <li><a href=""><i class="material-icons">format_list_bulleted</i><span>&nbsp;Ver Calificaciones por Materia</span></a></li>
        <li><a href=""><i class="material-icons">format_list_numbered</i><span>&nbsp;Ver Calificaciones por Alumno</span></a></li>
        <li><a href=""><i class="material-icons">format_list_numbered</i><span>&nbsp;Ver Calificaciones por Grupo</span></a></li>
        @if(Entrust::hasRole('docente'))
            <li role="separator" class="divider"></li>
            <li><a href=""><i class="material-icons">people</i><span>&nbsp;Registrar Padres/Tutores</span></a></li>
        @endif
    </ul>
</li>