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
        require_once '../../Clases/clsNavbar.php';
        
        $objNavBar = new NavBar();
        $objNavBar->DefineNavBar();
        
        ?>
        
      <!-- container -->
      <div id="page-wrapper">

          <div class="row">
              <div class="col-xs-12 col-sm-offset-2 col-sm-12">
                  <br><br><br> 
                <h1>Módulo Almacen</h1>
                <p>Módulo desarrollado para Gestionar el almacén de la Municipalidad Distrital de Motupe</p>
            </div>  
          </div>  
 
      </div>

 
      
      
    </div> 


    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>
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
