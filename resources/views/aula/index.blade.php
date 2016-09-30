@extends('app')

@section('content')
      <div class="container">
          @include('flash::message')
          <div class="row">
              <div class="panel panel-primary">
                  @include('aula.segmentos.panelaulas')
                  <div class="panel-footer">
                      {!! link_to('/escuela/aulas/create','Asignar',array('class'=>'btn btn-primary','role'=>'button'),null) !!}
                  </div>
              </div>
          </div>
      </div> <!-- container -->
      @include('aula.segmentos.modalDelete')
@stop

@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
    <script src="{{asset('/js/Aula.js')}}"></script>
@stop