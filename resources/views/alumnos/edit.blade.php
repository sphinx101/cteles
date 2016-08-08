@extends('app')

@section ('content')
    @include('alumnos.segmentos.openTagsForm')
    <div class="panel-body">
        {!! Form::model($alumno,['role'=>'form','route'=>['escuela.alumnos.update',$alumno->id],'method'=>'PATCH']) !!}
           @include('alumnos.segmentos.campos')
    </div>
    @include('alumnos.segmentos.closeTagsForm')
@endsection

