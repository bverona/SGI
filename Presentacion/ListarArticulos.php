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

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="LlenaTipo();Filtro();">

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Navbar </span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <a class="navbar-brand" href="">Gestión de Módulos</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">Nuevo Artículo</a></li>
              <li><a href="#">Reportes</a></li>
              <li><a href="#"></a></li>
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

      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
                <div class="panel panel-success">
                    <div class="panel-heading"><b>Listado de Artículos</b>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover">
                                  <thead>
                                    <tr>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th>Artículo</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>
                                            <select class="form-control" id="cbTipo" name="cbTipo" onchange="Filtro();">
                                                <option value=0>
                                                    Todos
                                                </option>
                                        </select>
                                        </th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                  
                                  </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        </div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">

        function LlenaTipo() {
            $.post("../Funciones/llenarTipo.php")
                    .done(function(data) {
                         $("#cbTipo").append(data);
                    });
        }

        function Filtro()
        {
            var id = $("#cbTipo").val();
            $.post("../Funciones/MuestraArticulos.php",{id:id})
                    .done(function(data) {
                        $("#tbody").html(data);
                    });
            
        }
        
    </script>
</html>
