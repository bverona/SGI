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

    <title>Listar Artículo</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="LlenarSelect();Filtro();">

        
        <!-- Container -->
            <div class="container">
                <?php
               /*
                *  Define el Tipo de NavBar a Usar
               */
                  require_once '../../Clases/clsNavbar.php';
                  $objNavBar= new NavBar();
                  $objNavBar->DefineNavBar();
               ?>
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Listado de Artículos</b>
                        <div class="panel-body panel-success">
                            <div class="table-responsive table-hover">
                                <table class="table table-striped table-hover">
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

<!--         Modal Nuevo Artículo
            <form name="frmgrabarArticulo" id="frmgrabarArticulo" method="post" action="../../Funciones/NuevoArticulo.php">
                <div class="modal fade" id="NuevoArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Nuevo Artículo</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Artículo">
                                    </div>
                                    <div class="form-group">
                                            <label for="unidad">Unidad</label>
                                            <input type="text" class="form-control" name="unidad" id="unidad" required placeholder="Unidad de medida">
                                    </div>
                                    <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad" required placeholder="Cantidad">
                                    </div>
                                    <div class="form-group">
                                        <label for="cbtipo">Tipo</label>
                                        <select class="form-control" id="cbTipo" name="cbtipo">
                                                <option value="0">Seleccione Tipo</option>
                                            <?php 
                                            require_once '../../Clases/clsTipo.php';
                                            $objTipo = new TipoArticulo();
                                            $objTipo->SelectTipoArticulo();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                            <input type="button" class="btn btn-primary btn-success" data-target="#NuevoTipo" data-toggle="modal" aria-hidden="true" value="Nuevo Tipo">
                                    </div>
                                    <div class="form-group">
                                            <label for="codigo">Código </label>
                                            <input type="text" class="form-control" name="codigo" readonly id="codigo" required placeholder="codigo">
                                    </div>
                                    <div class="form-group">
                                            <label for="precio">Precio </label>
                                            <input type="text" class="form-control" name="precio" id="precio" required placeholder="Precio Unitario">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>        
         /Modal Nuevo Artículo

         Modal Nuevo Tipo
            <form name="frmgrabarTipo" id="frmgrabarTipo" method="post" action="">
                    <div class="modal fade" id="NuevoTipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Nuevo Tipo</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombreTipo" id="nombreTipo" required placeholder="Nombre Tipo" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-success" data-dismiss="modal" aria-hidden="true" onclick="RegistraTipo()">Aceptar</button>
                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                      </div>
                    </div>
            </form>        
         /Modal Nuevo Tipo

            -->
            

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
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
</html>
