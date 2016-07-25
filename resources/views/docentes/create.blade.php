@extends('app')

@section('content')
    @include('docentes.segmentos.openTagsForm')
    <div class="panel-body">
       {!! Form::open(['role'=>'form','route'=>'escuela.docentes.store']) !!}
            @include('centrotrabajo.segmentos.campos')
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            @include('docentes.segmentos.campos')
    </div>
    @include('docentes.segmentos.closeTagsForm')

@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>
@endsection