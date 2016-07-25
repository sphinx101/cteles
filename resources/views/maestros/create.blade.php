@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'maestros.store']) !!}

        @include('maestros.fields')

    {!! Form::close() !!}
</div>
@endsection
