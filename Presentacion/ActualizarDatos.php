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

        
     <?php
     /*
      *  Define el Tipo de NavBar a Usar ( Gerente, Almacén, Area)
      * esto se justifica porque un usuario con menores privilegios
      * podría acceder a funciones que no le corresponden
     */
        require_once '../Funciones/Navbar.php';
        $objNavBar= new NavBar();
        $objNavBar->DefineNavBar();
     ?>
  

      <!-- container -->
      <div class="container">
        <div class="row">            
            <div class="col-xs-offset-1 col-xs-10 col-sm-6 col-md-6 col-lg-offset-2 col-lg-6">		
                <form action="../Funciones/modificaDatos.php" method="POST" role="form">
                        <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nuevo Usuario">
                        </div>
                        <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass" required placeholder="Nueva Contraseña">
                        </div>
                        <div class="form-group">
                                <label for="pass2">Ingrese Password Nuevamente</label>
                                <input type="password" class="form-control" name="pass2" id="pass" required placeholder="Contraseña Nuevamente">
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
