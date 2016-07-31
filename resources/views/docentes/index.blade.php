@extends('app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Docentes Registrados para el Centro de Trabajo {!! $TituloTabla !!} </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @if($docentes->isEmpty())
                               <div class="well text-center">No Existen Docentes Registrados</div>
                        @else
                            <table class="table table-hover">
                                <thead>

                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Rfc</th>
                                    <th>CURP</th>
                                    <th># Celular</th>
                                    <th># Tel. Part.</th>
                                    <th width="290px">Accion</th>
                                </thead>
                                <tbody>

                                @foreach($docentes as $docente)
                                    <tr>

                                        <td>{{$docente->id }}</td>
                                        <td>{{ $docente->nombre .' '.$docente->appaterno .' '.$docente->apmaterno }}</td>
                                        <td>{{ $docente->rfc }}</td>
                                        <td>{{$docente->curp }}</td>
                                        <td>{{ $docente->celular }}</td>
                                        <td>{{ $docente->telefono }}</td>
                                        <td>

                                            {!! Form::open(['route'=>['escuela.docentes.destroy',$docente->id],'method'=>'DELETE','id'=>'frmBorrar']) !!}
                                                <a href="{!! route('escuela.docentes.show',[$docente->id]) !!}" class="btn btn-success" role="button"><i class="material-icons">remove_red_eye</i> </a>
                                                <a href="{!! route('escuela.docentes.edit', [$docente->id]) !!}" class="btn btn-info" role="button"><i class="material-icons">mode_edit</i></a>
                                                <button class="btn btn-danger" type="submit"><i class="material-icons">delete_forever</i></button>

                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $docentes->render()!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>

@endsection