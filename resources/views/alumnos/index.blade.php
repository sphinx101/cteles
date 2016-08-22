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
                       <div id="paginacion">
                           @include('alumnos.tabladatos')
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->

    <!-- TODO: separar en partials las ventanas modales-->
    <!-- Modal para Editar-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="panel panel-primary">
                    <div class="modal-header panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                    </div>
                    <div class="modal-body panel-body">
                        {!! Form::open(['role'=>'form','method'=>'PATCH','id'=>'frmEdit']) !!}
                        @include('alumnos.segmentos.campos')

                    </div>
                    <div class="modal-footer panel-footer">
                         {!! Form::button('Guardar Cambios', ['class' => 'btn btn-primary btnEditSubmit']) !!}
                         {!! Form::close() !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para Eliminar-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="panel panel-warning">
                    <div class="modal-header panel-heading">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel2">Eliminar Alumno</h4>
                    </div>
                    <div class="modal-body panel-body">
                      {!! Form::open(['role'=>'form','method'=>'DELETE','id'=>'frmBorrar']) !!}
                      {!! Form::label('',null,array('id'=>'lblPregunta')) !!}
                    </div>
                    <div class="modal-footer panel-footer">
                       {!! Form::button('Eliminar', ['class' => 'btn btn-primary btnDeleteSubmit']) !!}
                       {!! Form::close() !!}
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
    <script src="{{asset('/js/editAlumno.js')}}"></script>
    <script src="{{asset('/js/paginacionAlumno.js')}}"></script>
@endsection