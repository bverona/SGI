<?php   
    session_name("SGI");
    session_start();
    
    if ( !isset($_SESSION["usuario"])){
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

    <title>Listado Salidas</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
  </head>

  <body onload="LlenaSelect();Filtro(<?php echo $_SESSION["id_almacen"] ?>)">

    <div id="wrapper">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>

             <div id="page-wrapper">
                 <br>
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Salidas </b></div>
                        <div class="panel-body">
                            <br>
                            <div class="table-responsive table-hover">
                                <div class="col-xs-12 form-group">
                                <table class="table table-striped table-hover table-bordered">
                                  <thead>
                                    <tr>
                                        <th>Almacén</th>
                                        <th>Fecha</th>
                                        <th>
                                            <select class="form-control col-xs-2" id="cbArticulo" name="cbArticulo" onchange="Filtro(<?php echo $_SESSION["id_almacen"] ?>);">
                                            <option value=0>Todos</option>
                                        </select>
                                        </th>
                                        <th>Cantidad</th>
                                        <th>Saldo</th>
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
    </div> <!-- /container -->

   <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
    
        function LlenaSelect() 
        {
        $.post("../../Funciones/llenarArticulo.php")
                .done(function(data) {
                     $("#cbArticulo").append(data);
                });
        }
        
        function Filtro(id)
        {
            var articulo = $("#cbArticulo").val();
            $.post("../../Funciones/MuestraSalidasArticulo.php",{id:id,articulo:articulo})
                    .done(function(data) {
                        $("#tbody").html(data);
                    });
         
        }

    </script>
  </body>
</html>
