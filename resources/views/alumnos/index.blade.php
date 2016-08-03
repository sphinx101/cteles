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
                                 <thead>
                                     <th>ID</th>
                                     <th>Nombre</th>
                                     <th>CURP</th>
                                     <th>Domicilio</th>
                                     <th>Localidad</th>
                                     <th>Tutor</th>

                                     <th width="290px">Accion</th>
                                 </thead>
                                 <tbody>
                                 @foreach($alumnos as $alumno)
                                         <tr>
                                             <td>{{ $alumno->id  }}</td>
                                             <td>{{ $alumno->nombre.' '.$alumno->appaterno.' '.$alumno->apmaterno }}</td>
                                             <td>{{ $alumno->curp }}</td>
                                             <td>{{ $alumno->domicilio  }}</td>
                                             <td>{{ $alumno->localidad }}</td>
                                             @if($alumno->nombretutor)
                                                <td><a href=""><span> {{ $alumno->nombretutor.' '.$alumno->aptutor.' '.$alumno->amtutor }}  </span></a></td>
                                             @else
                                                 <td><a href=""><span>Sin registrar</span></a></td>
                                             @endif

                                             <td>
                                                    {!! Form::open(['route'=>['escuela.alumnos.destroy'],'method'=>'DELETE','id'=>'frmBorrar','role'=>'form']) !!}
                                                        <a href="{!! route('escuela.alumnos.show',[$alumno->id]) !!}" class="btn btn-success" role="button"><i class="material-icons">remove_red_eye</i> </a>
                                                        <a href="{!! route('escuela.alumnos.edit', [$alumno->id]) !!}" class="btn btn-info" role="button"><i class="material-icons">mode_edit</i></a>
                                                        <button class="btn btn-danger" type="submit"><i class="material-icons">delete_forever</i></button>

                                                 {!! Form::close() !!}
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
    </div>

@endsection


@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>

@endsection