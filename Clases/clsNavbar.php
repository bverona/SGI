<?php    
//    session_name("SGI");
//    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:../../index.php");
    }
    class NavBar{

        public function DefineNavBar() {
            //navbar para gerente
       if($_SESSION["permisos"]==8)
       {
           echo'       
    <!-- Nav Bar -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Barra de Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Gerente</a>
            </div>
            <!-- /.navbar-header -->


            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle"  disabled data-toggle="dropdown" href="#">
                    '. $_SESSION["usuario"].'
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="ActualizarDatos.php"><i class="fa fa-gear fa-fw"></i> Modificar datos</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../Funciones/cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <!-- navbar-static-side -->
            <div class="navbar-default sidebar" role="navigation">
               
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="Gerente.php"><i class="glyphicon glyphicon-home"></i> Almacén General</a>
                        </li>
                        <li>
                            <a href="s"><i class="fa fa-users fa-fw"></i>Usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="s" data-toggle="modal" data-target="#NuevoUsuario">Nuevo Usuario</a>
                                </li>
                                <li>
                                    <a href="ListarUsuarios.php">Listar Usuarios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="s"><i class="fa fa-sitemap fa-fw"></i>Almacenes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a data-toggle="modal" data-target="#NuevoAlmacen" href="s">Nuevo Almacén</a></li>
                                <li><a  href="ListarAlmacenes.php">Listar Almacenes</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-building fa-fw"></i>Áreas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a data-toggle="modal" data-target="#NuevaArea" href="s">
                                        Nueva Area
                                    </a> 
                                </li>
                                <li>
                                    <a  href="ListarAreas.php">Listar Áreas</a>
                                </li>                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-clipboard fa-fw"></i>Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="PedidosAreaGerente.php">Listar Pedidos de Áreas</a></li>
                                <li><a href="PedidosAlmacenGerente.php">Listar Pedidos de Almacén</a></li>
                                <li><a href="PedidosPorArea.php">Pedidos por Área</a></li>
                                <li><a href="OrdenesDeCompra.php">Listar Ordenes de Compra</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                        <li>
                            <a href="s"><i class="fa fa-truck fa-fw"></i>Proveedores<span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                    <li>
                                        <a data-toggle="modal" data-target="#NuevoProveedor" href="#">
                                            Nuevo Proveedor
                                        </a> 
                                    </li>                                    
                                    <li>
                                        <a href="ListarProveedores.php">
                                            Listar Proveedores
                                        </a>
                                    </li>
                            </ul>
                            <!--nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="s"><i class="fa fa-bar-chart-o fa-fw"></i>Demanda<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="CalculaDemanda.php">Calcula Demanda</a></li>
                                <li><a href="Demanda.php">Listar Demandas</a></li>
                            </ul>                   
                        </li>

                    </ul>
                </div>
                
            </div>
            
            
        </nav>
        <!-- /Nav Bar -->


    <!-- Modal Nuevo Almacén-->
            <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../../Funciones/NuevoAlmacen.php">
                <div class="modal fade" id="NuevoAlmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Almacén!</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" maxlength="32" class="form-control" name="txtnombrealmacen" id="txtnombrealmacen" required placeholder="Nombre Almacén"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>        
    <!-- /Modal Nuevo Almacén-->

    <!-- Modal Nuevo Usuario-->
            <form name="frmgrabarUsuario" id="frmgrabarUsuario" method="post" action="../../Funciones/NuevoUsuario.php">
                <div class="modal fade" id="NuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Usuario</h4>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" maxlength="32" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" maxlength="32" class="form-control" name="pass" id="pass" required placeholder="Contraseña">
                                </div>
                                <div class="form-group" onclick="">
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="area" onclick="LlenaSelectNuevo(2);" value="2"> Área
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="almacen" value="4"  onclick="LlenaSelectNuevo(4);"> Almacén
                                    </label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="cbModulosNuevo" name="cbModulos" onchange="Verifica();">

                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" id="btnNuevoUsuario" disabled="true" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>        
    <!-- /Modal Nuevo Usuario-->

    <!-- Modal Nueva Área-->
            <form name="frmgrabarArea" id="frmgrabarArea" method="post" action="../../Funciones/NuevaArea.php">
                <div class="modal fade" id="NuevaArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nueva Área</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" maxlength="32" class="form-control" name="txtnombrearea" id="txtnombrearea" required placeholder="Nombre Área"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>        
    <!-- /Modal Nuevo Área-->

    <!-- Modal Nuevo Proveedor-->
            <form name="frmgrabarProveedor" id="frmgrabarProveedor" method="post" action="../../Funciones/NuevoProveedor.php">
                <div class="modal fade" id="NuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Proveedor!</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" maxlength="100" class="form-control" name="txtnombreproveedor" id="txtnombreproveedor" required placeholder="Nombre Proveedor"></p>
                                <p><input type="text" maxlength="40" class="form-control" name="txtdireccionproveedor" id="txtdireccionproveedor" required placeholder="Dirección Proveedor"></p>
                                <p><input type="text" class="form-control" name="txtrucproveedor" maxlength="10" id="txtrucproveedor" required placeholder="RUC Proveedor"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>        
    <!-- /Modal Nuevo Proveedor-->            



';
       }        
       else //navbar almacén General
           if($_SESSION["permisos"]==5)
           {
            echo'

    <!-- Nav Bar -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Barra de Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Gerente</a>
            </div>
            <!-- /.navbar-header -->


            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle"  disabled data-toggle="dropdown" href="#">
                    '. $_SESSION["usuario"].'
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="ActualizarDatos.php"><i class="fa fa-gear fa-fw"></i> Modificar datos</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../Funciones/cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <!-- navbar-static-side -->
            <div class="navbar-default sidebar" role="navigation">
               
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                        <a href="Almacen.php"><i class="fa fa-institution fa-fw"></i>Almacén General</a>
                        </li>
                        <li>
                        <a href="s"><i class="fa fa-users fa-fw"></i>Artículos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#NuevoArticulo" onclick="PosibleCodigo();LlenaTipo();LlenaUnidad()">Nuevo Artículo</a>
                                </li>
                                <li>
                                    <a href="ArticulosRegistrados.php" >Artículos Registrados</a>
                                </li>
                            </ul>   
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-file-pdf-o fa-fw"></i>Reportes<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="ListadoEntradas.php"> Listar Entradas</a></li>
                                <li><a href="ListadoSalidas.php">Listar Salidas</a></li>
                                <li><a href="PedidosArea.php">Listar Pedidos de Áreas</a></li>
                                <li><a href="MovimientosPorAlmacen.php">Listar Movimientos por Almacén</a></li>
                                <li><a href="Existencias.php">Existencias</a></li>
                                <li><a href="ResumenExistencias.php">Resumen Existencias</a></li>
                                <li><a href="CostoArticulos.php">Costo Artículos</a></li>
                            </ul>                   
                        </li>
                    
                        <li>
                            <a href="s"><i class="fa fa-arrows-h fa-fw"></i>Movimientos<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="RegistraEntrada.php">Registra Entrada</a></li>
                                <li><a href="RegistraSalida.php">Registra Salida</a></li>
                            </ul>                   
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-clock-o fa-fw"></i>Pedidos Almacen<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="PedidosAlmacen.php">Pedidos de Almacenes No Atendidos</a></li>
                                <li><a href="ResumenPedidosAlmacen.php">Resumen Pedidos de Almacenes</a></li>
                                <li><a href="PedidosAlmacenAtendidos.php">Pedidos de Almacenes Atendidos</a></li>
                            </ul>                   
                        </li>


                        <li>
                            <a href="s"><i class="fa fa-shopping-cart fa-fw"></i>Órdenes de Compra<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="ListaOrdenesCompra.php">Órdenes de Compra Realizadas</a></li>
                            </ul>                   
                        </li>
                        
                        <li>
                            <a href="s"><i class="glyphicon glyphicon-road"></i> Accesos<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="Accesos.php">Listar Accesos</a></li>
                            </ul>                   
                        </li>

                    </ul>
                </div>
                
            </div>
            
            
        </nav>
        <!-- /Nav Bar -->








        <!-- Modal Nuevo Artículo-->
            <form name="frmgrabarArticulo" id="frmgrabarArticulo" method="post" action="../../Funciones/NuevoArticulo.php">
                    <div class="modal fade" id="NuevoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Nuevo Artículo</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Artículo">
                                    </div>
                                    <div class="form-group">
                                            <label for="unidad">Unidad</label>
                                            <select class="form-control" id="cbUnidad" name="cbUnidad">
                                             <option value="0">Seleccione Unidad</option> 

                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <input type="button" class="btn btn-primary btn-success" data-target="#NuevaUnidad" data-toggle="modal" aria-hidden="true" value="Nueva Unidad">
                                    </div>
                                    <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad" required placeholder="Cantidad">
                                    </div>
                                    <div class="form-group">
                                        <label for="cbtipo">Tipo</label>
                                        <select class="form-control" id="cbTipo" name="cbtipo">
                                         <option value="0">Seleccione Tipo</option> 

                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <input type="button" class="btn btn-primary btn-success" data-target="#NuevoTipo" data-toggle="modal" aria-hidden="true" value="Nuevo Tipo">
                                    </div>
                                    <div class="form-group">
                                            <label for="codigo">Código </label>
                                            <input type="text" class="form-control" name="codigo" readonly id="codigo" required placeholder="codigo">
                                    </div>
                                    <div class="form-group">
                                            <label for="precio">Precio </label>
                                            <input type="text" class="form-control" name="precio" id="precio" required placeholder="Precio Unitario">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>

                        </div>
                      </div>
                    </div>
            </form>        
        <!-- /Modal Nuevo Artículo-->

            <!-- Modal Nuevo Tipo-->
                <form name="frmgrabarTipo" id="frmgrabarTipo" method="post" action="">
                        <div class="modal fade" id="NuevoTipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Nuevo Tipo</h4>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombreTipo" id="nombreTipo" required placeholder="Nombre Tipo" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-success" data-dismiss="modal" aria-hidden="true" onclick="RegistraTipo()">Aceptar</button>
                                    <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
|                        </div>
                </form>        
            <!-- /Modal Nuevo Tipo-->

            <!-- Modal Nueva Unidad-->
                <form name="frmgrabarUnidad" id="frmgrabarUnidad" method="post" action="">
                        <div class="modal fade" id="NuevaUnidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Nueva Unidad</h4>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" name="nombreUnidad" id="nombreUnidad" required placeholder="Nombre Unidad" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-success" data-dismiss="modal" aria-hidden="true" onclick="RegistraUnidad()">Aceptar</button>
                                    <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                </form>        
            <!-- /Modal Nueva Unidad-->

                ';
           }
           else //navbar subalmacen
               if($_SESSION["permisos"]==4)
                   {
                echo ' 
    <!-- Nav Bar -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Barra de Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Subalmacen</a>
            </div>
            <!-- /.navbar-header -->


            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle"  disabled data-toggle="dropdown" href="#">
                    '. $_SESSION["usuario"].'
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="ActualizarDatos.php"><i class="fa fa-gear fa-fw"></i> Modificar datos</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../Funciones/cerrarSesion.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <!-- navbar-static-side -->
            <div class="navbar-default sidebar" role="navigation">
               
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                        <a href="SubAlmacen.php"><i class="fa fa-institution fa-fw"></i>SubAlmacen</a>
                        </li>
                        <li>
                        <a href="s"><i class="fa fa-table  fa-fw"></i>Pedidos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="RealizaPedidosAlmacen.php">Realiza Pedidos</a>
                                </li>
                            </ul>   
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-file-pdf-o fa-fw"></i>Artículos<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="ListarArticulosSubAlmacen.php">Listar Artículos</a></li>
                            </ul>                   
                        </li>
                    
                        <li>
                            <a href="s"><i class="fa fa-arrows-h fa-fw"></i>Movimientos<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="RegistraEntrada.php">Registra Entrada</a></li>
                                <li><a href="RegistraSalida.php">Registra Salida</a></li>
                            </ul>                   
                        </li>

                        <li>
                            <a href="s"><i class="fa fa-file-text  fa-fw"></i>Reportes<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="MovimientosPorAlmacen.php">Listar Movimientos</a></li>
                                <li><a href="PedidosSubAlmacenAtendidos.php">Pedidos Atendidos</a></li>
                                <li><a href="PedidosSubAlmacenNoAtendidos.php">Pedidos No Atendidos</a></li>
                                <li><a href="ListadoEntradas.php"> Listar Entradas</a></li>
                                <li><a href="ListadoSalidas.php">Listar Salidas</a></li>
                                <li><a href="CostoArticulosSubAlmacen.php">Costo Artículos</a></li>                                
                            </ul>                   
                        </li>

                        <li>
                            <a href="s"><i class="glyphicon glyphicon-road"></i> Accesos<span class="fa arrow "> </span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="Accesos.php">Listar Accesos</a></li>
                            </ul>                   
                        </li>                        


                    </ul>
                </div>
                
            </div>
            
            
        </nav>
        <!-- /Nav Bar -->
                
    ';                   
                   }
           else  if($_SESSION["permisos"]==2)//navbar area
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