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
    <link rel="icon" href="../../Imagenes/logo muni motupe.png">

    <title>Listar Proveedores</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">

    <!-- Custom styles for this template -->
    <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">
        <link rel="stylesheet" href="../../jquery-css/jquery.ui.css">

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

        
        <!-- Modal Nuevo Proveedor-->
        <form name="frmgrabarProveedor" id="frmgrabarProveedor" method="post" action="../../Funciones/ActualizaProveedor.php">
            <div class="modal fade" id="ActualizaProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>Actualiza Proveedor!</h4>
                        </div>

                        <div class="modal-body">
                            <p><input type="text" class="form-control" name="txtnombreproveedor" id="txtnombreproveedor" required placeholder="Nombre Proveedor"></p>
                            <p><input type="text" class="form-control" name="txtdireccionproveedor" id="txtdireccionproveedor" required placeholder="Dirección Proveedor"></p>
                            <p><input type="text" class="form-control" name="txtrucproveedor" maxlength="10" id="txtrucproveedor" required placeholder="RUC Proveedor"></p>
                        </div>
                           <input type="hidden" name="id" id="id">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                            <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Modal Nuevo Proveedor-->            


        <!-- Modal GestionarArtículo-->
            <div class="modal fade" id="GestionaArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog-prov">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>Articulo Proveedor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-info">
                                <div class="panel-heading"><b>Registro de Artículos</b>
                                    <div class="panel-body panel-success">
                                        <div class="col-xs-12">    
                                            <div class="col-xs-5">
                                                <input autocomplete="on" type="text" class="form-control" name="articulo" id="txtarticulo" required placeholder="Artículo">
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="text" class="form-control" name="cantidad" id="cantidad" required placeholder="Cantidad">
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="text" class="form-control" name="unidad" id="unidad" readonly required placeholder="Unidad">
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="idArt" name="idArt">
                            <input type="hidden" id="idProv" name="idProv">
                            <button type="submit" class="btn btn-primary btn-success" onclick="RegistrarArticuloProveedor()" aria-hidden="true">Aceptar</button>
                            <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Modal GestionarArtículo-->                    

        <!-- Modal ArticuloxProveedor-->
            <div class="modal fade" id="ArticulosxProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog-prov">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>Articulos por Proveedor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-info">
                                <div class="panel-heading"><b>Listado de Artículos</b>
                                    <div class="panel-body panel-success">
                                        <div class="table-responsive table-hover">
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th class="text-center">Articulo</th>
                                                  <th class="text-center">Unidad</th>
                                                  <th class="text-center">Precio</th>
                                                  <th class="text-center">Cantidad</th>
                                                </tr>
                                              </thead>
                                              <tbody id="tbodyArticulosxProveedor" >
                                                  
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>    
                        <div class="modal-footer">
                            <input type="hidden" id="idArt" name="idArt">
                            <input type="hidden" id="idProv" name="idProv">
                            <button type="button" class="btn btn-primary btn-success" onclick="RegistrarArticuloProveedor()" data-dismiss="modal" aria-hidden="true" >Aceptar</button>
                            <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>            
                        
        <!-- /Modal ArticuloxProveedor-->                    

    <div class="panel panel-success">
        <div class="panel-heading"><b>Listado de Proveedores</b></div>
            <div class="panel-body">    
                <div class="row">
                    <div class=" col-xs-12 ">    
                        <div class="col-xs-1">
                            <p class="text-center"><b>Editar</b></p>
                        </div>    
                        <div class="col-xs-1 ">
                            <p class="text-center"><b>Eliminar</b></p>
                        </div>    
                        <div class="col-xs-2 ">
                            <p class="text-center"><b>Nombre</b></p>
                        </div>    
                        <div class=" col-xs-2 ">
                            <p class="text-center"><b>Dirección</b></p>
                        </div>    
                        <div class="col-xs-2 ">
                            <p class="text-center"><b>RUC</b></p>
                        </div>    
                        <div class="col-xs-1 ">
                            <p class="text-center"><b>Añadir Artículo</b></p>
                        </div>    
                        <div class="col-xs-1">
                            <p class="text-center"><b>Articulos Registrados</b></p>
                        </div>                            
                    </div>
                </div> 
                <?php
                require_once '../../Clases/clsProveedor.php';
                $obj=new Proveedor();
                $obj->ListarProveedores();
                ?>
            </div>
        </div>
        
    </div>
            
     
  </body>

    <!-- JQuery & Bootstrap-->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>

    <script src="../../Jquery/jquery.ui.autocomplete.js"></script>
    <script src="../../Jquery/jquery.ui.js"></script>

    <script type="text/javascript">
    
    $("#txtarticulo").autocomplete({
        source:"../../Funciones/BuscarArticulo.php",
        minLength:1,
        select: SeleccionarRegistro,// se ejecuta una vez que se ha seleccionado
        focus: MarcarRegistro //se ejecuta cuando se está seleccionando el item
    });    
    
    function SeleccionarProveedor(id)
    {
        $("#idProv").val(id);
    }

    function SeleccionarRegistro(event,ui)
    {
            var registro = ui.item.value;
            $("#txtarticulo").val(registro.art);
            $("#unidad").val(registro.unidad);
            $("#idArt").val(registro.id);

        event.preventDefault();
    } 
    
    function CambiarEstado(id,articulo)
    {
        $.post("../../Funciones/CambiarEstadoArticuloProveedor.php",
                {proveedor:id,articulo:articulo})
                .done(function(data){

                    MostrarArticulosPorProveedor(id);
                });
    }

    function MarcarRegistro (event,ui)
    {
            var registro = ui.item.value;
            $("#txtarticulo").val(registro.art);
            $("#unidad").val(registro.unidad);
            $("#idArt").val(registro.id);
            event.preventDefault();
    }    

    function RegistrarArticuloProveedor()
    {
        var id = $("#idArt").val();
        var cantidad=$("#cantidad").val(); 
        var precio=$("#precio").val();
        var prov= $("#idProv").val();
        $.post("../../Funciones/RegistrarArticuloProveedor.php",
            {articulo:id, cantidad:cantidad, precio:precio, proveedor:prov})
                 .done(function(data){
                    alert("registrado");
                    MostrarArticulosPorProveedor(prov);
                    $("#idArt").val("");
                    $("#cantidad").val(""); 
                    $("#precio").val("");
                    $("#idProv").val("");
                    $("#txtarticulo").val("");
    });
    }

    function leerDatos(id)
    {
        $('#ActualizaProveedor').on('shown.bs.modal', function () {
            $('#nombre').focus();
        });
                
        $("#id").val(id);   
    } 

    function LlenaSelectNuevo(val) 
    {
        $.post("../../Funciones/llenarSelectNuevo.php", {valor_Rb: val})
           .done(function(data) {
               $("#cbModulosNuevo").html(data);
           });
    }     

    function ListarProveedores()
    {
    $.post("../../Funciones/LlenarSelectProveedores.php")
       .done(function(data) {
           $("#cbproveedores").html(data);
       });
    }
    
    
    function MostrarArticulosPorProveedor(idProv)
    {
        var  proveedor ="#proveedor";

        $.post("../../Funciones/MostrarArticulosProveedor.php",{proveedor:idProv})
                .done(function(data){

                    $(proveedor.concat(idProv)).html(data);
                });
    }
    
    </script>
</html>
