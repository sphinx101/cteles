@extends('app')

@section('content')
   <div class="container-fluid">
       @include('common.errors')
       @include('flash::message')
       <div class="row">
           <div class="col-md-6">
               <div class="panel panel-primary">
                   <div class="panel-heading">
                       <h4>Asignar Aula a Docente del Centro de Trabajo: <strong>{!! $TituloTabla !!}</strong></h4>
                   </div>
                   <div class="panel-body">
                       {!! Form::open(['role'=>'form','route'=>'escuela.aulas.store']) !!}
                       @include('aula.segmentos.campos')

                   </div>
                   <div class="panel-footer">
                       {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
                       {!! Form::close() !!}
                       {!! link_to('/escuela/aulas','Regresar',array('class'=>'btn btn-default','role'=>'button'),null) !!}
                   </div>
               </div>
           </div>
           <div class="col-md-6">
               <div class="panel panel-primary">
                   @include('aula.segmentos.panelaulas')
               </div>
           </div>
       </div>
   </div> <!-- container -->
   @include('aula.segmentos.modalDelete')
@endsection

@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
    <script src="{{asset('/js/Aula.js')}}"></script>
@endsection