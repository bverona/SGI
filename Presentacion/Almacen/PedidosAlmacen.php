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

    <title>Pedidos Atendidos</title>

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
        </div>
    </div>
        
    <!-- Modal Orden Compra-->        
        <form name="frmGeneraOrdenCompra" id="frmGeneraOrdenCompra" method="post" action="../../Funciones/GenerarOrdenCompra.php">
            <div class="modal fade" id="OrdenCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
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
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <p>
                                            <?php echo date('d-m-Y');?>
                                        </p>                                                                        
                                    </div>
                                </div>
                            </div>                                
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">                                    
                                    <label for="producto"><b>Producto</b></label>
                                    <input class="form-control" type="text" readonly id="producto" name="producto" value="Producto">                              
                                </div>                                
                                <div class="form-group">
                                <label for="cantidadoc"><b>Cantidad</b></label>
                                <input class="form-control" type="text" id="cantidadoc" name="cantidadoc" readonly value="0">
                              </div>
                                <div class="form-group">
                                    <label for="prioridad"><b>Prioridad</b></label>
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
                                <div class="form-group">
                                    <label for="observacion"><b>Observación</b></label>
                                    <textarea class="form-control" id="observacion" name="observacion" placeholder="Observación"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <input type="hidden" id="dp" name="dp" value="">
                                <input type="hidden" id="id_art" name="id_art" value="">
                                <input type="hidden" id="id_alm" name="id_alm" value="">
                                <button type="button" class="btn btn-primary btn-success" aria-hidden="true" onclick="GeneraOrdenCompra()">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>                                            
            </div>
        </form>       
    <!-- Modal Orden Compra-->                       
        
    <!-- Modal Orden Compra Faltante-->        
        <form name="frmGeneraOrdenCompra" id="frmGeneraOrdenCompra" method="post" action="../../Funciones/GenerarOrdenCompra.php">
            <div class="modal fade" id="OrdenCompraFaltante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
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
                                    <div class="col-xs-2 col-xs-offset-1">
                                        <p>
                                            <?php echo date('d-m-Y');?>
                                        </p>                                                                        
                                    </div>
                                </div>
                            </div>                                
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">                                    
                                    <label for="productof"><b>Producto</b></label>
                                    <input class="form-control" type="text" readonly id="productof" name="productof" value="Producto">                              
                                </div>                                
                                <div class="form-group">
                                    <label for="cantidadoReq"><b>Cantidad</b></label>
                                    <input class="form-control" type="text" id="cantidadReq" name="cantidadReq" readonly value="0">
                                </div>
                                <div class="form-group">
                                    <label for="prioridadf"><b>Prioridad</b></label>
                                    <select class="form-control" name="prioridadf" id="prioridadf">
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
                                <div class="form-group">
                                    <label for="observacion"><b>Observación</b></label>
                                    <textarea class="form-control" id="observacion" name="observacion" placeholder="Observación"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <input type="hidden" id="dpf" name="dpf" value="">
                                <input type="hidden" id="id_artf" name="id_artf" value="">
                                <input type="hidden" id="id_almf" name="id_almf" value="">
                                <button type="button" class="btn btn-primary btn-success" aria-hidden="true" onclick="GeneraOrdenCompraFaltante()">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>                                            
            </div>
        </form>       
    <!-- Modal Orden Compra Faltante-->                       
        
    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

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


    function LeerOrdenCompraFaltante(detallePedido,idArticulo,nombreArticulo,precio,proveedor,cantidadRequerida,resto)
    {
        $("#dp").val(detallePedido);
        $("#id_art").val(idArticulo);
        $("#productof").val(nombreArticulo);
        $("#precio").val(precio);
        $("#id_almf").val(proveedor);
        $("#cantidadoc").val(cantidadRequerida);
        $("#resto").val(resto);

    }
    
    function OrdenCompraFaltante(detallePedido,idArticulo,nombreArticulo,precio, proveedor,resto)
    {
        $.post("../../Funciones/GenerarOrdenCompraFaltante",
        {
            dp:detallePedido,
            id_art:idArticulo,
            nombreArticulo:nombreArticulo,
            precio:precio,
            proveedor:proveedor,
            resto:resto            
        }).done(function(data){
            
       });
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
                    alert(data);
                    location.reload();
                });
    }

    function GeneraOrdenCompra(){
        $.post("../../Funciones/GenerarOrdenCompra.php",
        {
          prioridad:$("#prioridad").val(),
          cantidadoc:$("#cantidadoc").val(),
          observacion:$("#observacion").val(),
          id_art:$("#id_art").val(),
          id_alm:$("#id_alm").val(),            
          dp:$("#dp").val()
        })
        .done(function (data){
           alert("Realizado Correctamente");
            location.reload();
        });
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
</body>
</html>
