<?php    
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    class NavBar{

        public function DefineNavBar() {
            //navbar para gerente
       if($_SESSION["permisos"]==8)
           {
       echo ' 
            <!-- Static navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">NavBar</span>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <a class="navbar-brand" href="Gerente.php">Gestión de Módulos</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a data-toggle="modal" data-target="#NuevoUsuario" href="#">
                                            Nuevo Usuario
                                        </a> 
                                    </li>
                                    <li><a href="ListarUsuarios.php">Listar Usuario</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Almacenes<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a data-toggle="modal" data-target="#NuevoAlmacen" href="#">  Nuevo Almacén</a></li>
                                    <li><a  href="ListarAlmacenes.php">Listar Almacenes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Áreas<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a data-toggle="modal" data-target="#NuevaArea" href="#">
                                            Nueva Area
                                        </a> 
                                    </li>
                                    <li>
                                        <a  href="ListarAreas.php">Listar Áreas</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="PedidosAreaGerente.php">Listar Pedidos de Áreas</a></li>
                                    <li><a href="PedidosAlmacenGerente.php">Listar Pedidos de Almacén</a></li>
                                    <li><a href="PedidosPorArea.php">Pedidos por Área</a></li>
                                </ul>
                            </li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">' .$_SESSION['usuario']. '<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                                    <li><a href="../../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </div>
            <!-- Static navbar -->

               ';
       }        
       else //navbar almacén General
           if($_SESSION["permisos"]==5)
           {
            echo'  
      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">NavBar</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <a class="navbar-brand" href="Almacen.php">Almacén General</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Artículos<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" data-toggle="modal" data-target="#NuevoArticulo">Nuevo Artículo</a></li>
                    <li><a href="ListarArticulos.php">Listar Artículos</a></li>                   
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav">
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="ListadoEntradas.php"> Listar Entradas</a></li>
                        <li><a href="ListadoSalidas.php">Listar Salidas</a></li>
                        <li><a href="PedidosArea.php">Listar Pedidos de Áreas</a></li>
                        <li><a href="MovimientosPorAlmacen.php">Listar Movimientos por Almacén</a></li>
               <!--     <li><a href="StockPorAlmacen.php">Listar Movimientos por Artículo</a></li> -->         
                    </ul>
              </li>
            </ul>                   

            <ul class="nav navbar-nav">
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Movimientos<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="RegistraEntrada.php">Registra Entrada</a></li>
                        <li><a href="RegistraSalida.php">Registra Salida</a></li>
                    </ul>
              </li>
            </ul>                   
            <ul class="nav navbar-nav">
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos Almacen<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="PedidosAlmacen.php">Pedidos de Almacenes No Atendidos</a></li>
                        <li><a href="PedidosAlmacenAtendidos.php">Pedidos de Almacenes Atendidos</a></li>
                    </ul>
              </li>
            </ul>                   
              
              <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['usuario'].'<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../../Funciones/cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
                
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <!--/Static navbar -->

                ';
           }
           else //navbar subalmacen
               if($_SESSION["permisos"]==4)
                   {
                echo ' 
      <!--  Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"></span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a class="navbar-brand" href="SubAlmacen.php">Gestión de Módulos</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="RealizaPedidosAlmacen.php">Realiza Pedidos</a></li>
                      </ul>
                </li>              

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Artículos<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li><a href="ListarArticulosSubAlmacen.php">Listar Artículos</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Movimientos<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="RegistraEntrada.php">Registra Entrada</a></li>
                        <li><a href="RegistraSalida.php">Registra Salida</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="PedidosSubAlmacen.php">Pedidos Realizados</a></li>

                  </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['usuario'].'<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <!-- /Static navbar -->
                
    ';                   
                   }
           else //navbar area
               {
               echo '
      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"></span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a type="button" class="navbar-brand" href="Area.php">Gestión de Módulos</a>
          </div>
          <div class="navbar-collapse collapse">
       
            <ul class="nav navbar-nav navbar-default">                
                <li>                
                <a href="RealizarPedidos.php">Realizar Pedidos</a>
                </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-default">                
                <li class="dropdown">                
                <a href="#" class="dropdown-toggle " data-toggle="dropdown">Reportes<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="PedidosPorArea.php">Pedidos realizados</a></li>
                </ul>
              </li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">                

                <li class="dropdown">                
                <a href="#" class="dropdown-toggle " data-toggle="dropdown">'.$_SESSION['usuario'].'<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
                </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <!-- /Static navbar -->

                   ';

           }
   }
    }
?>