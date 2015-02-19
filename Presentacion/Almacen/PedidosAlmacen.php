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
        <link rel="icon" href="../Imagenes/logo muni motupe.png">

        <title>Pedidos Por Almacen</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

    </head>

    <body>

        <div class="container">

            <?php
            /*
             *  Define el Tipo de NavBar a Usar
             */
            require_once '../../Clases/clsNavbar.php';
            require_once '../../Clases/clsPedido.php';

            $objNavBar = new NavBar();
            $objPed = new Pedido(0, 0, 0);

            $objNavBar->DefineNavBar();
            $objPed->ProcesaPedidos();
            ?>
            <div class="col-xs-12">
                <!-- Main component for a primary marketing message or call to action -->
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Pedidos</b>
                        <div class="panel-body">
                            <form role="form" action="ProcesaPedido.php" method="POST">
                                <div class="table-responsive table-hover">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Artículo</th>
                                                <th>Cantidad</th>
                                                <th>Usuario</th>
                                                <th>Almacen</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Soluciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php
                                            require_once '../../Clases/clsPedido.php';
                                            $objPed = new Pedido("", "", "");
                                            $objPed->ListarPedidosAlmacen();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Orden Compra-->
        <form name="frmGeneraOrdenCompra" id="frmGeneraOrdenCompra" method="post" action="../../Funciones/GeneraOrdenCompra.php">
            <div class="modal fade" id="OrdenCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialogo">
                    <div class="modal-content">                                 
                        <div class="modal-header">
                            <p><b>Orden de Compra : </b></p>
                            <p><b>Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></p>
                            <p><b>Hora &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></p>
                        </div>

                        <div class="modal-body">

                            <!-- Main component for a primary marketing message or call to action -->

                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Proveedor</th>
                                            <th>Prioridad</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td><input class="form-control" type="text" readonly="" id="producto" name="producto" value="Producto"></td>
                                            <td>
                                                <input class="form-control" type="text" id="precio" name="Precio" readonly="true" value="0"></td>
                                            <td>

                                                <input class="form-control" type="text" id="cantidad" readonly="true" name="cantidad" value="0">
                                            </td>
                                            <td>
                                                <button class="form-control btn btn-default btn-sm" data-toggle="modal"  id="btnProveedor" onclick="ListarProveedores()"  data-target="#ModalProveedores" value="">Seleccione Proveedor</button>
                                            </td>
                                            <td>
                                                <select class="form-control" name="prioridad" id="prioridad">                                                    
                                                    <option value="1"> 
                                                        Baja
                                                    </option>
                                                    <option value="2"> 
                                                        Media
                                                    </option>
                                                    <option value="3"> 
                                                        Alta
                                                    </option>
                                                </select>
                                            </td>   
                                            <td>
                                                <textarea class="form-control" id="observacion" name="observacion" placeholder="Observación"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                                      
                            </div>        
                            <input type="hidden" id="id_art" name="id_art" value="">
                            <input type="hidden" id="det_ped" name="det_ped" value="">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                            <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>       
        <!-- /Modal Orden Compra-->


        <!--Modal Proveedores -->           
        <div class="modal fade" id="ModalProveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog-prov">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Lista de Proveedores</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-success">
                            <div class="panel-heading"><b>Listado de Proveedores</b></div>
                                <div class="panel-body">
                                    <div class="table-responsive table-hover">
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th>Nombre</th>
                                              <th>Artículo</th>
                                              <th>Cantidad</th>
                                              <th>Precio</th>
                                              <th>Requerido</th>
                                            </tr>
                                          </thead>
                                          <tbody id="bodytablaproveedores">

                                              
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Proveedores-->            


    </body>
    
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">

        $('#NuevoArticulo').on('shown.bs.modal', function() {
            $('#nombre').focus();
        });
              
         
         function VerificaCantidad(cantidad)
         {
            var aux=$("#cantidadreq").val();
            aux =(aux+'').replace(/[^0-9]/,'');
            $("#cantidadreq").val(aux);    
            
        if( $("#cantidadreq").val() > cantidad )
            {
                $("#cantidadreq").val(cantidad);
            }
    }


        function ParametrosModal(dp, id_prod, nombre, precio, almacen)
        {
            $("#producto").val(nombre);
            $("#det_ped").val(dp);
            $("#precio").val(0);
            $("#cantidad").val(0);
            $("#id_art").val(id_prod);
            $("#btnProveedor").html('Seleccione Proveedor');
    }

        function ListarProveedores()
        {
            var articulo = $("#id_art").val();
        
            $.post("../../Funciones/MuestraProveedores.php",{articulo:articulo})
                    .done(function(data){
                       $("#bodytablaproveedores").html(data); 
                    });
        }

    function AsignaArticulo(precio,proveedor)
        {
            if(precio===-1)
            {
                $("#precio").val(0.0);
                $("#cantidad").val(0);
                $("#btnProveedor").html('No Proveedor');
            }else
            {
                $("#precio").val(precio);
                $("#btnProveedor").html(proveedor);
                $("#cantidad").val($("#cantidadreq").val());
            }
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

            if (val === 2)
            {
                $("#divmodulos").prop("hidden", false);
            } else
            {
                $("#divmodulos").prop("hidden", true);
            }

        }

        function Filtro()
        {
            var id = $("#cbTipo").val();
            $.post("../../Funciones/MuestraArticulos.php", {id: id})
                    .done(function(data) {
                        $("#tbody").html(data);

                    });

        }

    </script>

</html>
