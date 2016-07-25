@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Maestros</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('maestros.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($docentes->isEmpty())
                <div class="well text-center">No Existen Docentes Registrados</div>
            @else
                <table class="table table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Rfc</th>
                        <th>CURP</th>
                        <th width="50px">ACTION</th>
                    </thead>
                    <tbody>
                     
                        @foreach($docentes as $docente)
                            <tr>
                                <td>{!! $docente->nombre .' '.$docente->appaterno .' '.$docente->apmaterno !!}</td>
                                <td>{!! $docente->rfc !!}</td>
                                <td>{!! $docente->curp !!}</td>
                                <td>
                                    <a href="{!! route('docente.edit', [$docente->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{!! route('docente.delete', [$docente->id]) !!}" onclick="return confirm('Are you sure wants to delete this docente?')"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection