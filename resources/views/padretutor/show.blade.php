@extends('app')

@section('content')
    <div class="container-fluid">
        @include('common.errors')

        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><span>Datos Generales Padre/Tutor</span></h4>
                    </div>
                    <div class="panel-body">
                       @include('padretutor.segmentos.campos')
                    </div>
                    <div class="panel-footer">
                        {!! link_to('/home','Cerrar',array('class'=>'btn btn-primary','role'=>'button'),null) !!}
                        {!! link_to('/escuela/alumnos','Regresar',array('class'=>'btn btn-default','role'=>'button'),null) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
@endsection