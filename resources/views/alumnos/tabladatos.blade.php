@if($alumnos->isEmpty())
    <div class="well text-center">No Existen Alumnos Registrados</div>
@else
    <table class="table table-hover">
        <thead id="tblHeader">
        <th>ID</th>
        <th>Nombre</th>
        <th>CURP</th>
        <th>Domicilio</th>
        <th>Localidad</th>
        <th>Tutor</th>

        <th width="140px">Accion</th>
        </thead>
        <tbody>
        @foreach($alumnos as $alumno)
            <tr id='alumno{{$alumno->id}}'>
                <td>{{ $alumno->id  }}</td>
                <td>{{ $alumno->nombre.' '.$alumno->appaterno.' '.$alumno->apmaterno }}</td>
                <td>{{ $alumno->curp }}</td>
                <td>{{ $alumno->domicilio  }}</td>
                <td>{{ $alumno->localidad }}</td>
                @if($alumno->nombretutor)
                    <td><a href="#"><span> {{ $alumno->nombretutor.' '.$alumno->aptutor.' '.$alumno->amtutor }}  </span></a></td>
                @else
                    <td><a href=""><span>Sin registrar</span></a></td>
                @endif

                <td>
                    <!-- //Form::open(['route'=>['escuela.alumnos.destroy'],'method'=>'DELETE','id'=>'frmBorrar','role'=>'form']) !!}-->
                    <button type="button" class="btn btn-primary btn-xs btnEdit" data-toggle="modal" data-target="#myModal" data-alumno_id={{$alumno->id}}><i class="material-icons">mode_edit</i></button>

                    <!--a href="!! //route('escuela.alumnos.edit', [$alumno->id]) !!}" class="btn btn-info btn-xs" role="button"><i class="material-icons">mode_edit</i></a-->
                    <button type="button" class="btn btn-danger btn-xs btnDelete" data-toggle="modal" data-target="#myModal2"
                            data-alumno_id={{$alumno->id}} data-alumno_nombre={{$alumno->nombre}} data-alumno_app={{$alumno->appaterno}} data-alumno_apm={{$alumno->apmaterno}}>
                        <i class="material-icons">delete_forever</i></button>

                    <!--!! //Form::close() !!}-->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $alumnos->appends($curp_request)->render()!!}
@endif