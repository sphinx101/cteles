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
    @include('partials.modalOpenEdit')
        {!! Form::open(['role'=>'form','method'=>'PATCH','id'=>'frmEdit']) !!}
        @include('alumnos.segmentos.campos')
    @include('partials.modalCloseEdit')
    <!-- Modal para Eliminar-->
    @include('partials.modalOpenDelete')
        {!! Form::open(['role'=>'form','method'=>'DELETE','id'=>'frmBorrar']) !!}
        {!! Form::label('',null,array('id'=>'lblPregunta')) !!}
    @include('partials.modalCloseDelete')
@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
    <script src="{{asset('/js/editAlumno.js')}}"></script>
    <script src="{{asset('/js/paginacionAlumno.js')}}"></script>
@endsection