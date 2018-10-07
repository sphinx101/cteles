<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CTeles - Telesecundaria </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!--link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"-->
    <!-- NProgress -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <!--link href="../vendors/nprogress/nprogress.css" rel="stylesheet"-->
    <!-- Custom Theme Style -->
    <!--link href="../build/css/custom.min.css" rel="stylesheet"-->
    <link href="{{asset('/gentelella/css/custom.min.css') }}" rel="stylesheet">

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

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-home"></i> <span>{!! $cct_completo !!}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{asset('/gentelella/images/user.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h5>{!! $docente !!}</h5>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->   <!-- MENU LATERAL IZQUIERDO -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section"> <!-- MENU DE NAVEGACION PARA  DOCENTE Y/O DIRECTORES -->
                <h3>Navegacion ({!! $rol !!})</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-book"></i> Alumno <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if(Entrust::hasRole('docente'))
                          <li><a href="#a"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;Listar</a></li>
                          <li><a href="#a"><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>&nbsp;Asistencia</a></li>
                          <div role="separator" class="divider"></div>
                          <li><a href="#a"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Registrar Calificaciones</a></li>
                        @endif
                          <li><a href="#a"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>&nbsp;Calificaciones por Materia</a></li>
                          <li><a href="#a"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>&nbsp;Calificaciones por Alumno</a></li>
                          <li><a href="#a"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>&nbsp;Calificaciones por Grupo</a></li>
                        @if(Entrust::hasRole('docente'))
                          <div role="separator" class="divider"></div>
                          <li><a href="#a"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Registrar Padres/Tutores</a></li>
                        @endif
                    </ul>
                  </li>
                  @if(Entrust::can(['control-total','control-director','control-docente']))
                      <li><a><i class="fa fa-user"></i> Docente <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('escuela.docentes.index')}}"><span></span>&nbsp;Datos Generales</a></li>

                            @if(Entrust::hasRole('director') || Entrust::hasRole('admin'))

                              <li><a href="{{route('escuela.aulas.index')}}"><span></span>&nbsp;Aula asignada</a></li>

                            @endif
                            @if(Entrust::hasRole('supervisor') || Entrust::hasRole('admin') )
                               <li><a href="{{ route('escuela.docentes.index') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Registrar Docente</a></li>
                            @endif
                        </ul>
                      </li>
                      @if(Entrust::hasRole('director'))
                          <li><a><i class="fa fa-desktop"></i> Inscripcion <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="{{route('escuela.alumnos.create')}}"><span></span>&nbsp;Registrar Alumno</a></li>
                              <li><a href="{{route('escuela.alumnos.index')}}"><span></span>&nbsp;Listar Alumnos Registrados</a></li>
                              <div role="separator" class="divider"></div>

                              <li><a href="#w"><span></span>&nbsp;Inscribir Alumno</a></li>
                              <li><a href="{{route('escuela.alumnos.index')}}"><span></span>&nbsp;Alumnos Con Inscripcion</a></li>
                              <li><a href="{{route('escuela.alumnos.index')}}"><span></span>&nbsp;Alumnos Sin Inscripcion</a></li>

                            </ul>
                          </li>
                      @endif
                      @if(Entrust::hasRole('admin'))
                        <li><a><i class="fa fa-table"></i> Herramientas <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="#q"><span></span>&nbsp;Respaldar Base de Datos</a></li>
                          </ul>
                        </li>
                      @endif
                  @endif
                </ul>  
              </div>
              <div class="menu_section">  <!-- MENU DE NAVEGACION PARA ALUMNOS -->
                <h3>Navegacion Alumnos</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Estudiante<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#AT">Tareas</a></li>
                      <li><a href="#AE">Ejercicios</a></li>
                      <li><a href="#AH">Horario</a></li>
                      <li><a href="#AA">Asistencias</a></li>
                      <li><a href="#AC">Calificaciones</a></li>
                    </ul>
                  </li>
                  <!--  MULTINIVEL DE OPCIONES
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="">Level Two</a>
                            </li>
                            <li><a href="">Level Two</a>
                            </li>
                            <li><a href="">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="">Level One</a>
                        </li></li>
                    </ul>
                  </li>                  
                  -->
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Configuracion">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Bloquear">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a href="login.html" data-toggle="tooltip" data-placement="top" title="Cerrar Sesion">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('/gentelella/images/img.jpg')}}" alt="">{!! $user !!}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="#profile"> Perfil</a></li>
                    <!--li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Configuracion</span>
                      </a>
                    </li-->
                    <li><a href="javascript:;">Ayuda</a></li>
                    <li><a href="#logout"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
				  <!-- LISTA DE NOTIFICACIONES -->
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="{{asset('/gentelella/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{asset('/gentelella/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{asset('/gentelella/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{asset('/gentelella/images/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>Mostrar todas las notificaciones</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Titulo del menu de navegacion Activo (Alumno, Docente, Inscripcion, Herramientas, etc...)</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Busqueda...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Buscar</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Titulo de la opcion activa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <!--li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>  -->
                      <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">  CONTENIDO A MOSTRAR DE LA OPCION DEL MENU SELECCIONADA
                       @yield('content')
                  </div>
				</div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<!--script src="../vendors/jquery/dist/jquery.min.js"></script-->
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script-->
	<!-- FastClick -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <!--script src="../vendors/fastclick/lib/fastclick.js"></script-->
	<!-- NProgress -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <!--script src="../vendors/nprogress/nprogress.js"></script-->
    <!-- Custom Theme Scripts -->
    <script src="{{asset('/gentelella/js/custom.min.js')}}"></script>

    <!--toastrjs notification -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>


    @yield('script')

  </body>
</html>
