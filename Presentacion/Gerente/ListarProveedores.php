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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

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
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Articulo Proveedor</h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel panel-info">
                                    <div class="panel-heading"><b>Listado de Artículos</b>
                                        <div class="panel-body panel-success">
                                            <div class="table-responsive table-hover">
                                                <table class="table table-striped table-hover">
                                                  <thead>
                                                    <tr>
                                                        <th>Artículo</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                        <th>
                                                            Añadir     
                                                        </th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody">

                                                  </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <input type="hidden" name="id" id="id">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /Modal GestionarArtículo-->            
      
      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-lg-6">    

                    <?php
                    require_once '../../Clases/clsProveedor.php';
                    $obj=new Proveedor();
                    $obj->ListarProveedores();
                    ?>

            </div>
          </div>          
      </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>

    <script type="text/javascript">
    
    function leerDatos(id)
    {
        $('#ActualizaProveedor').on('shown.bs.modal', function () {
            $('#nombre').focus();
        });
                
        $("#id").val(id);   
    }

    //para implementar el eliminar primero se deben realizar los pedidos por 
    //las áreas y la gestión por parte de los almacenes
    function eliminar(p_dni) 
    {

    alert("Antes de implementar ver Requerimientos para eliminar Áreas");
//        if (confirm("Esta seguro de eliminar")) {
//            $.post("../../Funciones/InactivaAlmacen.php", {id_usu: p_dni})
//                    .done(function(data) {
//                        alert(data);
//                        document.location.href = "ListarUsuarios.php";
//                    });
//        }

    }
    
    function SelectAlmacen() {            
      $("#area").prop("checked", false) ;
      $("#almacen").prop("checked", true) ;
         $.post("../../Funciones/llenarSelect.php", {valor_Rb: 4})
                 .done(function(data) {
                     $("#cbModulos").html(data);
                     $("#cbModulos").val(valor);
                 });
     }

     function SelectArea() 
     {
      $("#almacen").prop("checked", false);
      $("#area").prop("checked", true);
         $.post("../../Funciones/llenarSelect.php", {valor_Rb: 2})
                 .done(function(data) {
                     $("#cbModulos").html(data);
                     $("#cbModulos").val(valor);
                 });
     }

     function LlenaSelectNuevo(val) {

     $.post("../../Funciones/llenarSelectNuev.ophp", {valor_Rb: val})
                     .done(function(data) {

                         $("#cbModulosNuevo").html(data);
                     });
         }

    function Filtro()
    {
        var almacen = $("#cbAlmacen").val();
        $.post("../../Funciones/MuestraArticulosAlmacen.php",{almacen:almacen})
                .done(function(data) 
        {
            if(data=="")
            {
            $("#tbody").html(
            "<label class='lead'>No Hay ningún artículo en este almacen</label>");
            }
            else
            {
                $("#tbody").html(data);
            }   

        });

    }
     

    var valorrb;

    function ValorArea() {
        valorrb = $('#area').val();
    }

    function ValorAlmacen() {
        valorrb = $('#almacen').val();
    }
    function LlenaSelect(val) {
        //alert(valorrb);
        $.post("../../Funciones/llenarSelect.php", {valor_Rb: val})
                .done(function(data) {

                    $("#cbModulos").html(data);
                });
    }

    </script>
  </body>
</html>
