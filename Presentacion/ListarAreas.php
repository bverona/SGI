<?php   
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">
    <link rel="icon" href="../Imagenes/logo muni motupe.png">

    <title>Realizar Pedidos</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only panel-success">Toggle navigation</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a class="navbar-brand" href="../Presentacion/Gerente.php">Gestión de Módulos</a>
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
                        <li>    
                            <a data-toggle="modal" data-target="#NuevoAlmacen" href="#">
                          Nuevo Almacén
                        </a>
                        </li>
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
                            <a  href="ListarAreas.php">Listar Areas</a>
                        </li>
                    </ul>
              </li>
<!--               <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="">Reporte 1</a></li>
                        <li><a href="">Reporte 2</a></li>
                    </ul>
              </li>-->

              </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                        <li><a href="../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

    <form name="frmgrabar" id="frmgrabar" method="post" action="../Funciones/ActualizaArea.php">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                                          
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nombre">Nuevo Nombre </label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Área">
                        </div>
                        <input type="hidden" name="id" id="id">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" aria-hidden="true">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>    
      
      
      
      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-lg-6">    

                    <?php
                    require_once '../Clases/clsArea.php';
                    $obj=new Area();
                    $obj->ListarAreas();
                    ?>

            </div>
          </div>          
      </div>

            <!-- Modal Nuevo Almacén-->
            <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../Funciones/NuevoAlmacen.php">
                    <div class="modal fade" id="NuevoAlmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Almacén!</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" class="form-control" name="txtnombrealmacen" id="txtnombrealmacen" required placeholder="Nombre Almacén"></p>
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
            <form name="frmgrabarUsuario" id="frmgrabarUsuario" method="post" action="../Funciones/NuevoUsuario.php">
                    <div class="modal fade" id="NuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Usuario</h4>
                            </div>

                            <div class="modal-body">
                                    <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Usuario">
                                    </div>
                                    <div class="form-group">
                                            <label for="pass">Contraseña</label>
                                            <input type="password" class="form-control" name="pass" id="pass" required placeholder="Contraseña">
                                    </div>
                                <div class="form-group" onclick="">
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="area" onclick="ValorArea();LlenaSelect();" value="2"> Área
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="almacen" value="4" onclick="ValorAlmacen();LlenaSelect();"> Almacén
                                    </label>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="cbModulos" name="cbModulos">

                                        </select>
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
            <!-- /Modal Nuevo Usuario-->

            <!-- Modal Nueva Área-->
            <form name="frmgrabarArea" id="frmgrabarArea" method="post" action="../Funciones/NuevaArea.php">
                    <div class="modal fade" id="NuevaArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nueva Área</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" class="form-control" name="txtnombrearea" id="txtnombrearea" required placeholder="Nombre Área"></p>
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
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
    
    function leerDatos(id)
    {
        $('#myModal').on('shown.bs.modal', function () {
            $('#nombre').focus();
        });
                
        $("#id").val(id);   
    }

    //para implementar el eliminar primero se deben realizar los pedidos por 
    //las áreas y la gestión por parte de los almacenes
    function eliminar(p_dni) {

    alert("Antes de implementar ver Requerimientos para eliminar Áreas");
//        if (confirm("Esta seguro de eliminar")) {
//            $.post("../Funciones/InactivaAlmacen.php", {id_usu: p_dni})
//                    .done(function(data) {
//                        alert(data);
//                        document.location.href = "ListarUsuarios.php";
//                    });
//        }

    }

        </script>

  </body>
</html>