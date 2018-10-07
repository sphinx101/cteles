@if(!$aulas_asignadas->isEmpty())
    <table class="table table-hover">
        <thead id="tblHeader">
            <th>Ciclo Escolar</th>
            <th>Docente</th>
            <th>Curp</th>
            <th>Grado</th>
            <th>Grupo</th>
            <th>Turno</th>
            <th width="50px">Accion</th>
        </thead>
        <tbody>

                   @foreach($aulas_asignadas as $aula)
                        <tr id='aula{{$aula->id}}'>
                            <td>{!! $aula->cicloescolar->ciclo !!}</td>
                            <td>{!! $aula->docente->nombre_completo !!}</td>
                            <td>{!! $aula->docente->curp !!}</td>
                            @if($aula->grado->id==1)
                                <td><span class="label label-primary">{!! $aula->grado->nom_grado !!}</span></td>
                            @elseif($aula->grado->id==2)
                                <td><span class="label label-info">{!! $aula->grado->nom_grado !!}</span></td>
                            @else
                                <td><span class="label label-success">{!! $aula->grado->nom_grado !!}</span></td>
                            @endif
                            @if($aula->grupo->nom_grupo==='A')
                                <td><span class="label label-success">{!! $aula->grupo->nom_grupo !!}</span></td>
                            @elseif($aula->grupo->nom_grupo==='B')
                                <td><span class="label label-primary">{!! $aula->grupo->nom_grupo !!}</span></td>
                            @else
                               <td><span class="label label-info">{!! $aula->grupo->nom_grupo !!}</span></td>
                            @endif

                            <td>
                                @if($aula->turno->nom_turno==='MATUTINO')
                                   <span class="label label-default">{!! $aula->turno->nom_turno !!}</span>
                                @else
                                    <span class="label label-warning">{!! $aula->turno->nom_turno !!}</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs btnDelete" data-toggle="modal" data-target="#modalDelete"
                                        data-aula_id={{$aula->id}} data-nombre_docente="{{$aula->docente->nombre_completo}}"
                                        data-grupo="{{$aula->grupo->nom_grupo}}" data-grado="{{$aula->grado->nom_grado}}"
                                        data-turno="{{$aula->turno->nom_turno}}" data-ciclo="{{$aula->cicloescolar->ciclo}}">
                                        <i class="material-icons">delete_forever</i></button>
                            </td>
                        </tr>
                   @endforeach

        </tbody>
    </table>
    {!! $aulas_asignadas->render()!!}


@else
    <div class="well text-center">No se han asignado aulas</div>
@endif