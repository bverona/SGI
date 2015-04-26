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

        
      
      
      <!-- Main component for a primary marketing message or call to action -->
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-lg-6">    
                    <?php
                    require_once '../../Clases/clsAlmacen.php';
                    $obj=new Almacen();
                    $obj->ListarAlmacenes();
                    ?>

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
      
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
    
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
