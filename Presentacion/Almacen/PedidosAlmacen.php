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
            ?>

            <!-- Main component for a primary marketing message or call to action -->            

        <div class="panel panel-info">
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
                            <div class="col-xs-1">
                                <p class="text-center"><b>Fecha</b></p>
                            </div>    
                            <div class="col-xs-2 ">
                                <p class="text-center"><b>Estado</b></p>
                            </div>    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Soluciones</b></p>
                            </div>                            
                            <div class="col-xs-1 ">
                                <p class="text-center"><b>Cancelar</b></p>
                            </div>  
                        </div>
                    </div>
                    <?php 
                        $objPed->ListarPedidosAlmacen();
                    ?>
                </div>
        </div>

        <!-- Modal Orden Compra-->
        <form name="frmGeneraOrdenCompra" id="frmGeneraOrdenCompra" method="post" action="../../Funciones/GenerarOrdenCompra.php">
            <div class="modal fade" id="OrdenCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialogo ">
                    <div class="modal-content">                                 
                        <div class="modal-header">
                            <div class="container-fluid">
                                <div class="row" >
                                    <div class="col-xs-12">
                                        <h4 class="text-center text-primary">
                                            <p> Orden de Compra</p>
                                        </h4>                                                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-1">
                                        <p>
                                            <b> Fecha:</b>
                                        </p>                                                                        
                                    </div>
                                    <div class="col-xs-1">
                                        <p>
                                            <?php echo date('d-m-Y');?>
                                        </p>                                                                        
                                    </div>
                                </div>
                            </div>                                
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                  <div class="col-xs-3"><p class="text-center"><b>Producto</b></p></div>
                                  <div class="col-xs-2"><p class="text-center"><b>Cantidad</b></p></div>
                                <div class="col-xs-2"><p class="text-center"><b>Prioridad</b></p></div>
                                <div class="col-xs-5"><p class="text-center"><b>Observación</b></p></div>
                              </div>
                              <div class="row">
                                <div class="col-xs-3">
                                    <input class="form-control" type="text" readonly id="producto" name="producto" value="Producto">
                                </div>
                                <div class="col-xs-2">
                                    <input class="form-control" type="text" id="cantidadoc" name="cantidad" readonly value="0">
                                </div>
                                <div class="col-xs-2">
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
                                </div>
                                <div class="col-xs-5">
                                <textarea class="form-control" id="observacion" name="observacion" placeholder="Observación"></textarea>
                                </div>
                               </div>
                              </div>
                            </div>                            
                            <div class="modal-footer">
                                <input type="hidden" id="dp" name="dp" value="">
                                <input type="hidden" id="id_art" name="id_art" value="">
                                <input type="hidden" id="id_alm" name="id_alm" value="">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>


                    </div>
                
            </div>
        </form>       
        <!-- /Modal Orden Compra-->
           
        </div>
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
    
    var detped;
    
    function AsignaDP(dp)
    {
         detped=dp;
        alert(pedido.concat(detped));
    }
    

    function CancelaPedido(dp){
        
        if(confirm("¿Desea Elimiar el pedido?")){
            $.post("../../Funciones/CancelarPedido.php",{dp:dp})
                    .done(function(){
                        alert("Pedido Eliminado");
                        location.reload();
                    });        
        }
            
    }
    
    var pedido="#CancelarPedido";
    
    $(function(){
    //    $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    
     
    function MostrarPosiblesSoluciones(dp,id_art,nombre_articulo,precio,destino,cantidad)
    {
       var origen =$("#origen").val(); 
       var pedido="#pedido";
        $.post("../../Funciones/MostrarPosiblesSoluciones.php",
            {dp:dp,id_art:id_art,nombre_articulo:nombre_articulo,
             precio:precio,destino:destino,origen:origen,cantidad:cantidad})
                .done(function(data){
                   $(pedido.concat(dp)).html(data); 
                });
    }
         
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

    function ParametrosModal(dp, id_art, nombre, cantidad, almacen)
{
        $("#producto").val(nombre);
        $("#id_alm").val(almacen);
        $("#cantidadoc").val(cantidad);
        $("#id_art").val(id_art);
        $("#dp").val(dp);
}

    function AsignaArticulo(precio,proveedor,id_prov)
    {
        if(precio===-1)
        {
            $("#precio").val(0.0);
            $("#cantidad").val(0);
            $("#id_prov").val(0);
            $("#btnProveedor").html('No Proveedor');
        }else
        {
            $("#preciooc").val(precio);
            $("#btnProveedor").html(proveedor);
            $("#id_prov").val(id_prov);
            $("#cantidadoc").val($("#cantidadreq").val());
        }
    }

    function ProcesaPedido(prov, dest, articulo, cantidad, dp)
    {
                    alert(prov+"/"+dest+"/"+articulo+"/"+cantidad+"/"+dp);
        $.post("../../Funciones/ProcesaPedidos.php", {
            prov: prov, dest: dest, articulo: articulo, cantidad: cantidad, dp: dp})
                .done(function(data)
                {
                    alert('Pedido Procesado');
                    location.reload();
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

    //llena el textarea #codigo con el POSIBLE código a generar
   function PosibleCodigo(){
        $.post("../../Funciones/PosibleId.php")
                .done(function (data){
                    $("#codigo").val(data);
        });
    }

    function RegistraTipo()
    {
        var nombre = $("#nombreTipo").val();
        $.post("../../Funciones/nuevoTipo.php",{nombre:nombre})
                .done(function(data){
                    LlenaTipo();
                });
    }

    function LlenaTipo() {
        $.post("../../Funciones/llenarTipo.php")
                .done(function(data) {
                     $("#cbTipo").html("");
                     $("#cbTipo").append('<option value="0">Seleccione tipo</option>');
                     $("#cbTipo").append(data);
                     $("#nombreTipo").val("");
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
