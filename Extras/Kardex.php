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

    <title>Control Visible de Almacén</title>

    <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Personaliza este archivo -->
        <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
        
      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
          <div class="row">
            <div class="col-xs-12 col-lg-offset-1 col-lg-8">
            <div class="row">
                <div class="col-xs-2">
                    <img class="img-responsive" src="../../Imagenes/logo muni motupe.png" alt="Logo" >
                </div>
                <div class="col-xs-10">
                  <h4>Municipalidad Distrital de Motupe</h4>
                  <h6>Tupac Amaru N° 531 - Telf: 426013</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-offset-1 col-lg-8">
                    
                </div>
            </div>

            </div>
          </div>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>

  </body>
</html>
