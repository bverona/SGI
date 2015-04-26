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

    <title>Actualiza Datos Personales</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/css/Jumbotron.css">

  </head>

  <body>

    <div class="container">

        
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
  

      <!-- container -->

        <div class="row">            
            <div class="col-xs-offset-1 col-xs-10 col-sm-6 col-md-6 col-lg-offset-2 col-lg-6">		
                <form action="../../Funciones/modificaDatos.php" method="POST" role="form">
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
      <!-- /container -->
      
      <!-- Modal Nuevo Artículo-->
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
                                        <label for="cbtipo">Tipo</label>
                                        <select class="form-control" id="cbtipo" name="cbtipo">
<!--                                            <option value="0">Seleccione Tipo</option>-->
                                            <?php 
                                            require_once '../../Clases/clsTipo.php';
                                            $objTipo = new TipoArticulo();
                                            $objTipo->SelectTipoArticulo();
                                            ?>
                                        </select>
 
                                    </div>
                                    <div class="form-group">
                                            <label for="codigo">Código </label>
                                            <input type="text" class="form-control" name="codigo" id="codigo" required placeholder="codigo">
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
      <!-- /Modal Nuevo Artículo-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
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
