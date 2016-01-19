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

    <body onload="MuestraDemanda();">

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
                    <div class="row" id="Listado">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal Calcula Demanda-->
        <div class="modal fade" id="CalculaDemanda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4>Nuevo Usuario</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="demanda">Demanda</label>
                            <input type="text" readonly class="form-control" name="demanda" id="demanda" >
                        </div>
                        <div class="form-group">
                            <label for="pass">Costo Preparación</label>
                            <input type="text" class="form-control" name="costoPreparacion" id="costoPreparacion" required placeholder="Costo de Preparacion">
                        </div>
                        <div class="form-group">
                            <label for="pass">Costo Almacenamiento</label>
                            <input type="text" class="form-control" name="costoAlmacenamiento" id="costoAlmacenamiento" required placeholder="Costo de Almacenamiento">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-success" id="btnNuevoUsuario" onclick="ValidaCampos();ProcesaDemanda()" aria-hidden="true">Aceptar</button>
                        <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>        
    <!-- /Modal Calcula Demanda-->        
        
        
        
<!-- jQuery -->
<script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

<script src="../../Jquery/numeric.js"></script>


<script>

//        $("#txtprecio").numeric({ decimal: false, negative: false });
//        $("#txtdni").numeric({ decimal: false, negative: false });
//        $("#txttelefono").numeric({ decimal: false, negative: false });
//        $("#txtdescuento").numeric({ decimal: false, negative: false });
//        $("#txtcantidad").numeric({ decimal: false, negative: false });

    $("#costoAlmacenamiento").numeric({ decimalPlaces: 2, negative: false });
    $("#costoPreparacion").numeric({ decimalPlaces: 2, negative: false });
    var idArt;
    
    function leerDatosDemanda(id)
    {
        idArt=id;
        $("#demanda").val($("#dem"+id).html());
    }

    function MuestraDemanda()
    {
        $.post("../../Funciones/MuestraDemanda.php")
            .done(function(data) {
                $("#Listado").html(data);
            });
    }
    
    function ValidaCampos(){
        if($("#costoPreparacion").val()=="")
        {
            $("#costoPreparacion").focus();
        }else 
            if($("#costoAlmacenamiento").val()=="")
            {
                $("#costoAlmacenamiento").focus();
            }
    }
    
    function ProcesaDemanda()
    {
        $.post("../../Funciones/ProcesaDemanda.php",
        {
            id_art:idArt,
            demanda:$("#demanda").val(),
            costoAlmacenamiento:$("#costoAlmacenamiento").val(),
            costoPreparacion:$("#costoPreparacion").val()
        }).done(function(data){
            alert(data);
        })
    }
</script>

</body>
</html>
