<?php
session_name("SGI");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestión Compras</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../../../bootstrap/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../../bootstrap/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <div id="wrapper">


        <!-- Nav Bar -->
        <?php
            require_once '../../../Clases/clsNavbar2.php';
            $obj= new NavBar2();
            $obj->DefineNavBar();
        ?>
        <!-- Nav Bar -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sistema Gestor de Compras</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->     
            
            <div class="row">

                <div class="col-xs-12 col-lg-offset-2 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-envelope-o fa-fw"></i> Solicitudes de Compra
                                                        
                        </div>
                        <!-- /.panel-heading -->

                        <div class="panel-body">
                            <p>
                                <b>Requiere:</b>
                            </p>
                            <p>
                                10 tn Piedra chancada de 1/2
                            </p>
                            <p>
                                <b>Prioridad</b> Alta
                            </p>
                            <p>
                                <b>Obra:</b> Pavimientación calle El Carmen
                            </p>
                            <p>
                                <b>Días a Esperar</b> 03
                            </p>
                            <p>
                                <b>Horas a Esperar</b> 04 
                            </p>
                            
                            <p>
                                <a href="#" class="btn btn-outline btn-lg btn-primary" data-toggle="modal" data-target="#Proveedores">Cotizaciones</a>
                            </p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                    
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal Nuevo Almacén-->
            <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../../Funciones/NuevoAlmacen.php">
                <div class="modal fade" id="Proveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Proveedores</h4>
                            </div>

                            <div class="modal-body">
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Artículo</th>
                                            <th>Precio</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Marañon E.I.R.L</td>
                                            <td>Piedra chancada de 1/2</td>
                                            <td>150.5</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                        <tr>
                                            <td>FerPerú S.A.C</td>
                                            <td>Piedra chancada de 1/2</td>
                                            <td>160</td>
                                            <td><a href="#" class="btn btn-outline btn-primary">Comprar</a></td>
                                        </tr>
                                        <tr>
                                            <td>Tumi S.A.</td>
                                            <td>Piedra chancada de 1/2</td>
                                            <td>151.2</td>
                                            <td><a href="#" class="btn btn-outline btn-primary" >Comprar</a></td>
                                        </tr>
                                    </tbody>
                                </table>
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
    
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>