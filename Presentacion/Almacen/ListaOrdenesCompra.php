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

        <title>Órdenes de Compra</title>

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

            $objNavBar = new NavBar();
            
            $objNavBar->DefineNavBar();
            ?>

        <div class="panel panel-success">
            <div class="panel-heading">
                        <div class=" col-xs-12">    
                            <div class="col-xs-6 col-sm-3">
                                <p class="text-center"><b>Listado de Órdenes de Compra</b></p>
                            </div>    
                        </div>
                <p><br></p>
            </div>
                <div class="panel-body">                          
                    <div class="row">
                        <div class=" col-xs-12">    
                            <div class="col-xs-1">
                                <p class="text-center"><b>Codigo</b></p>
                            </div>    
                            <div class="col-xs-2 ">
                                <p class="text-center"><b>Artículo</b></p>
                            </div>    
                            <div class="col-xs-2 ">
                                <p class="text-center"><b>Usuario</b></p>
                            </div>    
                            <div class="col-xs-1 ">
                                <p class="text-center"><b>Cantidad</b></p>
                            </div>    
                            <div class=" col-xs-2 ">
                                <p class="text-center"><b>Prioridad</b></p>
                            </div>    
                            <div class="col-xs-2">
                                <p class="text-center"><b>Almacen</b></p>
                            </div>    
                            <div class="col-xs-2 ">
                                <p class="text-center"><b>Fecha</b></p>
                            </div>    
                        </div>
                    </div>
                    <?php 
                        require '../../Clases/clsOrdenCompra.php';
                        $objOrd= new OrdenCompra();
                        $objOrd->ListarOrdenesDeCompra();
                    ?>
                </div>
        </div>
           
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
