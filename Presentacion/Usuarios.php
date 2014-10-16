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

    <title>Creación de Usuarios</title>

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
              <span class="sr-only">Toggle navigation</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a class="navbar-brand" href="Gerente.php">Inicio</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="ListarUsuarios.php">Listar Usuarios</a></li>
                <li><a href="Reportes.php">Reportes</a></li>
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
            <div class="row">            
                <div class="col-xs-offset-1 col-xs-10 col-sm-6 col-md-6 col-lg-offset-2 col-lg-6">		
                    <form action="../Funciones/NuevoUsuario.php" method="POST" role="form">
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
                            <input class="btn btn-primary" type="Submit" value="Crear Usuario">
                    </form>
                </div>
            </div>
              
     </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
 
    <script type="text/javascript">        
        var valorrb ;
        
        function ValorArea(){
        valorrb = $('#area').val();
        }        
        
        function ValorAlmacen(){
        valorrb = $('#almacen').val();
        }      

        function LlenaSelect(){
        $.post( "../Funciones/llenarSelect.php", { valor_Rb: valorrb})
        .done(function( data ) {
            $("#cbModulos").html(data);
        });

    }
    </script>
 

  </body>
</html>
