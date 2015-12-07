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

    <title>Pedidos SubAlmacen Atendidos</title>

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
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
        
      <!-- Main component for a primary marketing message or call to action -->
        <div id="page-wrapper"><br>
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Pedidos</b></div>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table table-hover table-condensed">
                                  <thead>
                                    <tr>

                                        <th>Artículo</th>
                                        <th>Cantidad</th>
                                        <th>Usuario</th>
                                        <th>Almacen</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                  <?php 
                                  require_once '../../Clases/clsPedido.php';
                                  $objPed= new Pedido("","","");
                                  $objPed->ListarPedidosSubAlmacenAtendidos($_SESSION["id_almacen"]);
                                  ?>
                                  </tbody>
                                </table>
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

    <script type="text/javascript">

    $('#NuevoArticulo').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $(document).ready(function (){        
          $('#cantidad').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
          $('#cantidadsalida').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
     });

       function leerDatosEntrada(id_) 
        {
            $.post("../../Funciones/DatosArticulo.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombre").val(data.nombre);
                        $("#saldo").val(data.cantidad);
                        $("#id").val(data.id);
                    }, "json");                    
        }
    
       function leerDatosSalida(id_) 
        {
            $.post("../../Funciones/DatosArticulo.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombresalida").val(data.nombre);
                        $("#saldosalida").val(data.cantidad);
                        $("#idsalida").val(data.id);
                    }, "json");                    
        }
    
        function LlenaTipo() {
            $.post("../../Funciones/llenarTipo.php")
                    .done(function(data) {
                         $("#cbTipo").append(data);
                    });
        }

        function DefineSalida(val)
        {

            if (val===2)
            {
                $("#divmodulos").prop("hidden",false);
            }else
                {
                    $("#divmodulos").prop("hidden",true);
                }
                
        }

        function Filtro()
        {
            var id = $("#cbTipo").val();
            $.post("../../Funciones/MuestraPedidosSubAlmacen.php")
                    .done(function(data) {
                        alert(data);
                        $("#tbody").html(data);
                    });
         
        }

    </script>
  </body>
</html>
