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
    <link rel="icon" href="../Imagenes/logo muni motupe.png">

    <title>Módulo Almacén</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

        <?php
        require_once '../../Clases/clsNavbar.php';
        
        $objNavBar = new NavBar();
        $objNavBar->DefineNavBar();
        
        ?>
        
      <!-- container -->
      <div class="jumbotron">
          <h1>Módulo Almacen</h1>
          <p>Módulo desarrollado para Gestionar el almacén de la Municipalidad Distrital de Motupe</p>
      </div>

 
      
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <script>
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
                        LlenaTipo();//hace que se actualice inmediatamente
                    });
        }
 
        function LlenaTipo(){
            $.post("../../Funciones/llenarTipo.php")
                    .done(function(data) {
                         $("#cbTipo").html("");
                         $("#cbTipo").append('<option value="0">Seleccione tipo</option>');
                         $("#cbTipo").append(data);
                         $("#nombreTipo").val("");
                    });
        }

        function RegistraUnidad()
        {
            var nombre = $("#nombreUnidad").val();
            $.post("../../Funciones/nuevaUnidad.php",{nombre:nombre})
                    .done(function(data){
                        LlenaUnidad();//hace que se actualice inmediatamente
                    });
        }
 
        function LlenaUnidad(){
            $.post("../../Funciones/LlenarUnidad.php")
                    .done(function(data) {
                         $("#cbUnidad").html("");
                         $("#cbUnidad").append('<option value="0">Seleccione Unidad</option>');
                         $("#cbUnidad").append(data);
                         //$("#cbUnidad").val("");
                    });
        }

    </script>
  </body>
</html>
