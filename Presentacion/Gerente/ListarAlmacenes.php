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

    <title>Gestionar Almacenes</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

  </head>

  <body onload="llenarTabla()">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
      
      <!-- Main component for a primary marketing message or call to action -->
      <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-xs-12 col-lg-6">    
                    <br>
                    <div class="panel panel-success">
                    <div class="panel-heading">
                        <b>Listado de Almacenes</b>
                    </div>
                        <div class="panel-body">
                            <div class="table-responsive table-hover">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Editar</th>
                                      <th>Eliminar</th>
                                      <th>Almacén</th>
                                      <th>Estado</th>
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
            </div>          
        </div>
      
      
    <!-- Modal Editar Almacén-->
            <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../../Funciones/EditarAlmacen.php">
                <div class="modal fade" id="EditarAlmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Nuevo Almacén!</h4>
                            </div>

                            <div class="modal-body">
                                <p><input type="text" maxlength="32" class="form-control" name="editaralmacen" id="editaralmacen" required placeholder="Nombre Almacén"></p>
                            </div>
                            <input type="hidden" id="idEditado" name="idEditado">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>        
    <!-- /Modal Editar Almacén-->    
      

    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script type="text/javascript">
    
    function llenarTabla(){
    $.post("../../Funciones/LlenarAlmacenes.php")
        .done(function(data) {
            $("#tbody").html(data);
            });
        }
    
    function leerDatos(id,nombre) 
    {

        $('#EditarAlmacen').on('shown.bs.modal', function () {
            $('#editaralmacen').focus();
        });
        alert(id);
        $("#idEditado").val(id);
        $("#editaralmacen").val(nombre);
          
    }


    //para implementar el eliminar primero se deben realizar los pedidos por 
    //las áreas y la gestión por parte de los almacenes
    function eliminar(id) {

        $.post("../../Funciones/EliminaAlmacen.php",{id:id})
                .done(function(data){
                    alert("Eliminado");
                    location.reload();
    });        
    }

        function SelectAlmacen(valor) {
            
            //alert(valor + " valor almacen");
         $("#area").prop("checked", false) ;
         $("#almacen").prop("checked", true) ;
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 4})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(valor);
                    });
        }

        function SelectArea(valor) {
            //alert(valor+ " valor area");
         $("#almacen").prop("checked", false);
         $("#area").prop("checked", true);
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 2})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(valor);
                    });
        }

        </script>

        <script type="text/javascript">
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
            function LlenaSelectNuevo(val) {
                  
                $.post("../../Funciones/llenarSelectNuevo.php", {valor_Rb: val})
                        .done(function(data) {

                            $("#cbModulosNuevo").html(data);
                        });
            }

        </script>

  </body>
</html>
