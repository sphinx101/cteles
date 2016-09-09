@extends('app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Padres/Tutores Registrados para  Centro de Trabajo: <strong>{!!$TituloTabla!!}</strong>  </h4>
                    <h4>TOTAL REGISTRADO:  {!!$total_registrados  !!} Personas </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                      @if(!$pt->isEmpty())
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Localidad</th>
                                    <th># Telefono</th>
                                    <th># Celular</th>
                                    <th width="200px">Accion</th>
                                </thead>
                                <tbody>

                                @foreach($pt as $tutor)
                                    <tr>
                                        <td>{{$tutor->id}}</td>
                                        <td>{{$tutor->nombre.' '.$tutor->appaterno.' '.$tutor->apmaterno}}</td>
                                        <td>{{$tutor->localidad}}</td>
                                        <td>{{$tutor->telefono}}</td>
                                        <td>{{$tutor->celular}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs"><i class="material-icons">remove_red_eye</i></button>
                                            <button type="button" class="btn btn-primary btn-xs"><i class="material-icons">mode_edit</i></button>
                                            <button type="button" class="btn btn-danger btn-xs"><i class="material-icons">delete_forever</i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $pt->render() !!}

                      @else
                            <div class="well text-center">No Existen Padre/Tutor Registrados</div>
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