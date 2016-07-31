@extends('app')
@section ('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Alumnos Registrados para el Ciclo Escolar Actual del Centro de Trabajo{!! $TituloTabla !!}</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                             <thead>
                                 <th>ID</th>
                                 <th>Nombre</th>
                                 <th>CURP</th>
                                 <th>Domicilio</th>
                                 <th>Localidad</th>
                                 <th>Tutor</th>
                                 <th>Inscrito</th>
                                 <th width="290px">Accion</th>
                             </thead>
                             <tbody>
                             <tr>
                                 <td>1</td>
                                 <td>Reynaldo Victor Arceo</td>
                                 <td>VIAR780210HMNCRY09</td>
                                 <td>Diaz Ordaz #491</td>
                                 <td>Sahuayo</td>
                                 <td><a href="#"><span>Santiago Victor Morfin</span></a></td>
                                 <td>si</td>
                                 <td>

                                 </td>
                             </tr>

                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{asset('/js/opcionesMenu.js')}}"></script>

@endsection