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

    <title>Pedidos Por Área</title>

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
<div class="panel panel-success">
            <div class="panel-heading"><b>Listado de Pedidos</b>
            </div>
                <div class="panel-body">                          
                    <div class="row">
                        <div class=" col-xs-12">    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Articulo</b></p>
                            </div>    
                            <div class="col-xs-1 ">
                                <p class="text-center"><b>Cantidad</b></p>
                            </div>    
                            <div class="col-xs-1 ">
                                <p class="text-center"><b>Usuario</b></p>
                            </div>    
                            <div class=" col-xs-2 ">
                                <p class="text-center"><b>Almacén</b></p>
                            </div>    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Fecha</b></p>
                            </div>    
                            <div class="col-xs-2 ">
                                <p class="text-center"><b>Estado</b></p>
                            </div>    
                        </div>
                    </div>
                <?php
                  require '../../Clases/clsPedido.php';
                  $objPed=new Pedido(0, 0, 0);
                  $objPed->ListarPedidosAlmacenGerente();
                ?>

                </div>
        </div>
      
      
    </div> <!-- /container -->





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
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
            $.post("../../Funciones/MuestraArticulos.php",{id:id})
                    .done(function(data) {
                        $("#tbody").html(data);
              
                    });
         
        }
        
        function ProcesaPedido(prov, dest, articulo, cantidad, dp)
        {
            var id = $("#cbTipo").val();
            $.post("../../Funciones/ProcesaPedidos.php", {
                prov: prov, dest: dest, articulo: articulo, cantidad: cantidad, dp: dp})
                    .done(function(data)
                    {
                        alert('Pedido Procesado');
                    });
        }
        
    </script>
 
</html>
