<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Cteles - Control Telesecundaria</title>

	<!-- bootstrap twitter 3.3.6 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
		  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Material Design for Bootstrap -->
	<link href="{{ asset('/css/bootstrap-material-design.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/ripples.min.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<!--link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'-->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

	<!-- toastrjs notificaciones -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.css">

	@yield('style')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">CTeles</a>
			</div>

			<div class="collapse navbar-collapse navbar-ex1-collapse " id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><i class="material-icons">home</i><span> Inicio</span></a></li>

                @if(!(Auth::guest()))


					@include('partials.menudocente')

					@if(Entrust::can(['control-total','control-director','control-docente']))

                        @include('partials.menudirector')
                        @if(Entrust::hasRole('admin'))
                            @include('partials.menuadminadvanced')
                        @endif
                    @endif

                @endif
                </ul>
				<ul class="nav navbar-nav navbar-right">

					@if (Auth::guest())

						<li><a href="{{ url('/auth/login') }}">Identificarse</a></li>
						<li><a href="{{ url('/auth/register') }}">Registrarse</a></li>
					@else

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="material-icons">person</i><!--span class="glyphicon glyphicon-user" aria-hidden="true" -->
                                    &nbsp;{{Auth::user()->username }}&nbsp;<i class="material-icons">view_list</i><!--span class="glyphicon glyphicon-list-alt" aria-hidden="true" -->
                                    {{cteles\User::find(Auth::user()->id)->roles[0]->name}}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                                <li ><a href="{{ route('escuela.docentes.create') }}" id="lnkRegistrar"><i class="material-icons">save</i><span> Registar Datos</span></a></li>

                                <li><a href="{{ route('escuela.docentes.edit',Auth::user()->id) }}" id="lnkActualizar"><i class="material-icons">description</i><span > Actualizar Datos</span></a></li>
								<li><a href="{{ url('/auth/logout') }}"><i class="material-icons">power_settings_new</i><span> Cerrar Sesion</span></a></li>
							</ul>

						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>


	@yield('content')

	<!-- Scripts Requeridos -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
			integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="{{asset('/js/material.min.js')}}"></script>
	<script src="{{asset('/js/ripples.min.js')}}"></script>

	<!--toastrjs notification -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
	@yield('script')
</body>
</html>
