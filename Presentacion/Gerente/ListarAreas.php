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

    <title>Realizar Pedidos</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>

  <body onload="llenarTabla();">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>

        
    <form name="frmgrabar" id="frmgrabar" method="post" action="../../Funciones/ActualizaArea.php">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                                          
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nombre">Nuevo Nombre </label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Área">
                        </div>
                        <input type="hidden" name="id" id="id">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" aria-hidden="true">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>    
      
      
      
      <!-- Main component for a primary marketing message or call to action -->
      <div id="wrapper">
        <div id="page-wrapper">
          <div class="row">
              <div class="col-xs-12 col-lg-6">    
                  <br>
          
                    <div class="panel panel-success">
                        <div class="panel-heading"><b>Listado de Almacenes</b></div>
                            <div class="panel-body">
                                <div class="table-responsive table-hover">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                            <th>Areas</th>
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
    
      <!-- /container -->


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
    $.post("../../Funciones/LlenarAreas.php")
        .done(function(data) {
            $("#tbody").html(data);
            });
        }
    


    function leerDatos(id)
    {
        $('#myModal').on('shown.bs.modal', function () {
            $('#nombre').focus();
        });
                
        $("#id").val(id);   
    }

    function eliminar(id) {
        
        alert(id);

        $.post("../../Funciones/EliminaArea.php",{id:id})
                .done(function(data){
                    alert("Eliminado");
                    location.reload();
    });        
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

        function SelectArea() {
         $("#almacen").prop("checked", false);
         $("#area").prop("checked", true);
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 2})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(valor);
                    });
        }

        function LlenaSelectNuevo(val) 
    {
        $.post("../../Funciones/llenarSelectNuevo.php", {valor_Rb: val})
                        .done(function(data) {

                            $("#cbModulosNuevo").html(data);
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
