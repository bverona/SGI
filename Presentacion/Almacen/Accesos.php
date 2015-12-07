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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">

    <title>Accesos Sub almacén</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

  </head>

  <body onload="llenarTabla(<?php echo $_SESSION["id"] ?>)">

    <div id="wrapper">

        <?php 
            require_once '../../Clases/clsNavbar.php';
            $objNavbar = new NavBar();
            $objNavbar->DefineNavBar();
            ?>
        
      <!-- Main component for a primary marketing message or call to action -->
      <div id="page-wrapper">
          <div class="row">              
                   <div class="col-xs-12 col-md-9 col-lg-6">
                        <br>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <b>Listado de Usuarios</b>
                            </div>
                                <div class="panel-body">
                                    <div class="table-responsive table-hover">
                                        <table class="table table-condensed table-hover">
                                          <thead>
                                            <tr>
                                              <th><p class="text-center">Usuario</p></th>
                                              <th><p class="text-center">Fecha</p></th>
                                              <th><p class="text-center">Hora</p></th>
                                            </tr>
                                          </thead>
                                          <tbody id="tbody">
                                              
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>    
                    </div>

          </div>
      </div>

    </div> <!-- /container -->

    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script>
        function llenarTabla(usuario){
        $.post("../../Funciones/LlenarRegistro.php",{usuario:usuario})
            .done(function(data) {
                $("#tbody").html(data);
                });
        }
    </script>
  </body>
</html>
