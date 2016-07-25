@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($maestro, ['route' => ['maestros.update', $maestro->id], 'method' => 'patch']) !!}

        @include('maestros.fields')

    {!! Form::close() !!}
</div>
@endsection
