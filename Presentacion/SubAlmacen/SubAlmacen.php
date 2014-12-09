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

    <title>Sub Almacén</title>

    <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Personaliza este archivo -->
        <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

        <?php 
            require_once '../../Clases/clsNavbar.php';
            $objNavbar = new NavBar();
            $objNavbar->DefineNavBar();
            ?>
        
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
          <h1>Bienvenido :3</h1>
          <h3>Modulo para la gestión de SubAlmacenes</h3>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>

  </body>
</html>
