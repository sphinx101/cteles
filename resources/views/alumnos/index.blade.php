@extends('app')
@section ('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">

                        <h3>Alumnos Registrados  Centro de Trabajo {!! $TituloTabla !!}</h3>
                        {!! Form::model($curp_request,['route'=>['escuela.alumnos.index'],'method'=>'GET','role'=>'form','class'=>'form-inline text-right']) !!}

                        {!! Form::label('lblcurp','CURP',array('class'=>'sr-only')) !!}
                        {!! Form::text('curp',null,array('class'=>'form-control','id'=>'lblcurp','placeholder'=>'CURP Alumno')) !!}
                        {!! Form::submit('Buscar', ['class' => 'btn btn-info']) !!}
                         <a href="{{url('/escuela/alumnos')}}" class="btn btn-default" role="button">Mostrar Todos</a>
                        {!! Form::close() !!}

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
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
                                                        <button class="btn btn-danger btn-xs" type="button"><i class="material-icons">delete_forever</i></button>

                                                     <!--!! //Form::close() !!}-->
                                             </td>
                                         </tr>
                                 @endforeach
                                 </tbody>
                            </table>
                            {!! $alumnos->appends($curp_request)->render()!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['role'=>'form','method'=>'PATCH','id'=>'frmEdit']) !!}
                    @include('alumnos.segmentos.campos')

                </div>
                <div class="modal-footer">
                     {!! Form::button('Guardar Cambios', ['class' => 'btn btn-primary btnEditSubmit']) !!}
                     {!! Form::close() !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
    <script src="{{asset('/js/editAlumno.js')}}"></script>
@endsection