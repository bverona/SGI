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

    <title>Actualiza Datos Personales</title>

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
     /*
      *  Define el Tipo de NavBar a Usar ( Gerente, Almacén, Area)
      * esto se justifica porque un usuario con menores privilegios
      * podría acceder a funciones que no le corresponden
     */
        require_once '../../Clases/clsNavbar.php';
        $objNavBar= new NavBar();
        $objNavBar->DefineNavBar();
     ?>
  
    <div id="page-wrapper">

      <!-- container -->

        <div class="row">            
            <div class="col-xs-offset-1 col-xs-10 col-sm-6 col-md-6 col-lg-offset-2 col-lg-6">		
                <form action="../../Funciones/modificaDatos.php" method="POST" role="form">
                    <p></p>
                    <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nuevo Usuario">
                        </div>
                        <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass" required placeholder="Nueva Contraseña">
                        </div>
                        <div class="form-group">
                                <label for="pass2">Ingrese Password Nuevamente</label>
                                <input type="password" class="form-control" name="pass2" id="pass" required placeholder="Contraseña Nuevamente">
                        </div>
                        <input class="btn btn-primary" type="Submit" value="Modificar Datos">
                    </form>
            </div>

	</div>
      </div>
      </div>
      <!-- /container -->
      
    <!-- Modal Nuevo Almacén-->
      <form name="frmgrabarAlmacen" id="frmgrabarAlmacen" method="post" action="../../Funciones/NuevoAlmacen.php">
          <div class="modal fade" id="NuevoAlmacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-header">
                          <h4>Nuevo Almacén!</h4>
                      </div>

                      <div class="modal-body">
                          <p><input type="text" class="form-control" name="txtnombrealmacen" id="txtnombrealmacen" required placeholder="Nombre Almacén"></p>
                      </div>

                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                          <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>        
      <!-- /Modal Nuevo Almacén-->

      <!-- Modal Nuevo Usuario-->
      <form name="frmgrabarUsuario" id="frmgrabarUsuario" method="post" action="../../Funciones/NuevoUsuario.php">
          <div class="modal fade" id="NuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-header">
                          <h4>Nuevo Usuario</h4>
                      </div>

                      <div class="modal-body">
                          <div class="form-group">
                              <label for="nombre">Nombre</label>
                              <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombre Usuario">
                          </div>
                          <div class="form-group">
                              <label for="pass">Contraseña</label>
                              <input type="password" class="form-control" name="pass" id="pass" required placeholder="Contraseña">
                          </div>
                          <div class="form-group" onclick="">
                              <label class="radio-inline">
                                  <input type="radio" name="RadioInline" id="area" onclick="LlenaSelectNuevo(2);" value="2"> Área
                              </label>
                              <label class="radio-inline">
                                  <input type="radio" name="RadioInline" id="almacen" value="4" onclick="LlenaSelectNuevo(4);"> Almacén
                              </label>
                          </div>
                          <div class="form-group">
                              <select class="form-control" id="cbModulosNuevo" name="cbModulos">

                              </select>
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
      <!-- /Modal Nuevo Usuario-->

      <!-- Modal Nueva Área-->
      <form name="frmgrabarArea" id="frmgrabarArea" method="post" action="../../Funciones/NuevaArea.php">
          <div class="modal fade" id="NuevaArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">

                      <div class="modal-header">
                          <h4>Nueva Área</h4>
                      </div>

                      <div class="modal-body">
                          <p><input type="text" class="form-control" name="txtnombrearea" id="txtnombrearea" required placeholder="Nombre Área"></p>
                      </div>

                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-success" aria-hidden="true">Aceptar</button>
                          <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>

                  </div>
              </div>
          </div>
      </form>        
      <!-- /Modal Nuevo Área-->


    <!-- jQuery -->
    <script src="../../bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<script type="text/javascript">

    var valorrb;

    $('#myModal').on('shown.bs.modal', function()
    {
        $('#nombre').focus();
    });

    function leerDatos(id_)
    {
        $.post("../../Funciones/BuscarUsuario.php", {id: id_})
                .done(function(data) {
                    data = $.parseJSON(data);
                    $("#nombre").val(data.nombre);
                    $("#id").val(data.id);
                    if (data.idArea == '-' || data.idArea == '0')
                    {
                        //alert("almacen "+data.idAlmacen);
                        SelectAlmacen();

                        $("#antiguo").val(data.idAlmacen);
                        $("#cbModulos").val(data.idAlmacen);
                    } else
                    {
                        //alert("area "+data.idArea);
                        SelectArea();
                        $("#antiguo").val(data.idArea);
                        $("#cbModulos").val(data.idAlmacen);
                    }

                }, "json");
    }

    function eliminar(p_dni)
    {

        if (confirm("Esta seguro de eliminar")) {
            $.post("../../Funciones/EliminaUsuario.php", {id_usu: p_dni})
                    .done(function(data) {
                        document.location.href = "/Gerente/ListarUsuarios.php";
                    });
        }

    }

    function SelectAlmacen()
    {
        $("#area").prop("checked", false);
        $("#almacen").prop("checked", true);
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


    function ValorArea() {
        valorrb = $('#area').val();
    }

    function ValorAlmacen() {
        valorrb = $('#almacen').val();
    }

    function LlenaSelect(val) {
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
