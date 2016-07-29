@extends('app')

@section ('content')
    @include('alumnos.segmentos.openTagsForm')
    <div class="panel-body">
        {!! Form::open(['role'=>'form','route'=>'escuela.alumnos.store']) !!}
        <div class="form-group">
            <input type="hidden" name="centrotrabajo_id" value="{!! $ccts !!}}">

        </div>
    </div>
    @include('docentes.segmentos.closeTagsForm')
@endsection

@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
@endsection