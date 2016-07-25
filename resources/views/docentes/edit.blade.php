@extends('app')

@section('content')
    @include('docentes.segmentos.openTagsForm')
    <div class="panel-body">
        {!! Form::model($docente,['role'=>'form','route'=>['escuela.docentes.update',$docente->id],'method'=>'PATCH']) !!}
        @include('centrotrabajo.segmentos.campos')
        @include('docentes.segmentos.campos')
    </div>
    @include('docentes.segmentos.closeTagsForm')
@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
@endsection