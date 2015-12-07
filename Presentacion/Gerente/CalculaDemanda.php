<?php
session_name("SGI");
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
}
?>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">
    <link rel="icon" href="../../Imagenes/logo muni motupe.png">

    <title>Resumen Pedidos Atendidos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <?php
            /*
             *  Define el Tipo de NavBar a Usar
             */
            require_once '../../Clases/clsNavbar.php';
            require_once '../../Clases/clsPedido.php';

            $objNavBar = new NavBar();
            $objPed = new Pedido(0, 0, 0);
            
            $objNavBar->DefineNavBar();
            ?>


        <div id="page-wrapper"><br>   
            <div class="panel panel-info">
            <div class="panel-heading"><b>Listado de Pedidos</b></div>
                <div class="panel-body">                          
                    <div class="row">
                        <div class=" col-xs-12">    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Articulo</b></p>
                            </div>    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Cantidad</b></p>
                            </div>        
                            <div class="col-xs-2">
                                <p class="text-center"><b>Stock</b></p>
                            </div>        
                            <div class="col-xs-2">
                                <p class="text-center"><b>Proyección</b></p>
                            </div>        
                            <div class="col-xs-2">
                                <p class="text-center text-danger"><b>Demanda</b></p>
                            </div>        
                        </div>
                    </div>
                    <?php 
                        $objPed->ListarDemandaPedidos();
                    ?>
                </div>
            </div>
        </div>
    </div>
        
<!-- jQuery -->
<script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

</body>
</html>
