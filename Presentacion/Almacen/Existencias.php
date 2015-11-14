<?php   
    session_name("SGI");
    session_start();
    
    if ( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
    $almacen=($_SESSION["id_almacen"]);
    ?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bruno Verona">
    <link rel="icon" href="../Imagenes/logo muni motupe.png">

    <title>Existencias</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="../../bootstrap/bower_components/metisMenu/src/metisMenu.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
  </head>

  <body onload="LlenarSelect();Filtro();">

        
        <!-- Container -->
            <div class="wrapper">
                <?php
               /*
                *  Define el Tipo de NavBar a Usar
               */
                  require_once '../../Clases/clsNavbar.php';
                  $objNavBar= new NavBar();
                  $objNavBar->DefineNavBar();
               ?>
                
                <div id="page-wrapper">
                    <br>
                    <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Artículos</b></div>
                    <div class="panel-body panel-success">
                            <div class="table-responsive table-hover">
                                <table class="table table-condensed table-hover">
                                  <thead>
                                    <tr>
                                        <th>Artículo</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>
                                            <select class="form-control" id="cbAlmacen" onchange="Filtro()">
                                                <option value="0">Todos los Almacenes</option>
                                                
                                            </select>
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
        <!-- /container -->



    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">

    $('#NuevoArticulo').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $(document).ready(function (){        
          $('#cantidad').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
          $('#cantidadsalida').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
           
            });
     });


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
        
        //llena el select cbAlmacen con todos los almacenes
        function LlenarSelect() {
            $.post("../../Funciones/llenarSelect.php",{valor_Rb:5})
                    .done(function(data) {
                         $("#cbAlmacen").append(data);
                    });        }

        function DefineSalida(val)
        {

            if (val===2)
            {
                $("#divmodulos").prop("hidden",false);
            }else
                {
                    $("#divmodulos").prop("hidden",true);
                }
                
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

    </script>
</body>
</html>
