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

    <title>Actualiza Datos Personales</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/navbar.css" rel="stylesheet">

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
            <a class="navbar-brand" href="#">Gestión de Módulos</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="Usuarios.php">Usuarios</a></li>
              <li><a href="#">Reportes</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['usuario'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Modificar Datos</a></li>
                  <li><a href="../Funciones/cerrarSesion.php">Cerrar Sesión</a></li>
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
                <form action="../Funciones/modificaDatos.php" method="POST" role="form">
                        <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nuevo Usuario">
                        </div>
                        <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="Nueva Contraseña">
                        </div>
                        <div class="form-group">
                                <label for="pass2">Ingrese Password Nuevamente</label>
                                <input type="password" class="form-control" name="pass2" id="pass" placeholder="Contraseña Nuevamente">
                        </div>
                        <input class="btn btn-primary" type="Submit" value="Modificar Datos">
                    </form>
            </div>
        </div>

	</div>
      </div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

  </body>
</html>
