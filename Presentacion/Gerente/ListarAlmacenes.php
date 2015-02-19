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
      
    
      
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
    
    function leerDatos(id,nombre)
    {
        $('#myModal').on('shown.bs.modal', function () {
            $('#nombre').focus();
        })
        $("#id").val(id);
        
    }

    //para implementar el eliminar primero se deben realizar los pedidos por 
    //las áreas y la gestión por parte de los almacenes
    function eliminar(p_dni) {

        alert("Antes de implementar ver Requerimientos para eliminar Almacen");

//        if (confirm("Esta seguro de eliminar")) {
//            $.post("../../Funciones/InactivaAlmacen.php", {id_usu: p_dni})
//                    .done(function(data) {
//                        alert(data);
//                        document.location.href = "ListarUsuarios.php";
//                    });
//        }

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
