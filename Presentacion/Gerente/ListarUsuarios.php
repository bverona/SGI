<?php
session_name("SGI");
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
<!--        <meta name="viewport" content="width=device-width, initial-scale=1">-->
        <meta name="description" content="">
        <meta name="author" content="Bruno Verona">
        <link rel="icon" href="../../Imagenes/logo muni motupe.png">

        <title>Listar Usuarios</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

        <!-- Custom styles for this template -->
        <link href="../../bootstrap/css/Jumbotron.css" rel="stylesheet">

    </head>

    <body onload="ValorArea();ValorAlmacen();
          ">

        <div class="container">

        <?php
        /*
         *  Define el Tipo de NavBar a Usar
        */
           require_once '../../Clases/clsNavbar.php';
           $objNavBar= new NavBar();
           $objNavBar->DefineNavBar();
        ?>
            
            <!-- Componente para Mostrar los usuarios -->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-6">
                        <!-- Listar Usuarios-->         
                        <?php
                        require_once '../../Clases/ClsUsuario.php';
                        $objusuario = new Usuario();

                        $objusuario->ListarUsuarios();
                        ?>
                    </div>
                </div>
            </div>

            <!--Modal Actualizar Datos -->
            <form name="frmgrabar" id="frmgrabar" method="post" action="../../Funciones/ActualizaDatos.php">
                <div class="modal fade" id="ActualizarDatos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" maxlength="32" name="nombre" id="nombre2" required placeholder="Nombre Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" class="form-control" maxlength="32" name="pass" id="pass" required placeholder="Contraseña">
                                </div>
                                <div class="form-group" onclick="">
                                    <label class="radio-inline">
                                        <input type="radio" name="RadioInline" id="area"  onclick="ValorArea();LlenaSelect(2);"  value="2"> 
                                        Área
                                    </label>
                                    <label class="radio-inline" required>
                                        <input type="radio" name="RadioInline" id="almacen" value="4" onclick="ValorAlmacen();LlenaSelect(4);"> 
                                        Almacén
                                     </label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="cbModulos" onchange="Verifica()" name="cbModulos">

                                    </select>
                                </div>
                                <input type="hidden" name="id" id="id">
                            <input type="hidden" id="antiguo" name="antiguo" value=""> 

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger " id="btnEditaUsuario" disabled="true" aria-hidden="true">Aceptar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
		<!-- Fin Modal Actualizar Datos -->
  
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../Jquery/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript">

        function Verifica()
        {
            
            if($('#cbModulos').val()!=0)
            {
                $('#btnEditaUsuario').prop("disabled",false);
            }else 
            {
                $('#btnEditaUsuario').prop("disabled",true);
            }
        }


        function leerDatos(id_) 
        {
            $.post("../../Funciones/BuscarUsuario.php", {id: id_})
                    .done(function(data) {
                        data = $.parseJSON(data);
                        $("#nombre").val(data.nombre);
                        $("#id").val(data.id);
                        $("#nombre2").val(data.nombre);
                        
                        if(data.idArea == '-' || data.idArea == '0') 
                        {
                            SelectAlmacen();
                            $("#antiguo").val(data.idAlmacen);
                            $("#cbModulos").val(data.idAlmacen);
                        }else
                        {
                            SelectArea();
                            $("#antiguo").val(data.idArea);
                            $("#cbModulos").val(data.idArea);
                        }                        
                    }, "json");                    
        }

        function eliminar(p_dni)
        {

            if (confirm("Esta seguro de eliminar")) {
                $.post("../../Funciones/EliminaUsuario.php", {id_usu: p_dni})
                        .done(function(data) {

                            document.location.href = "ListarUsuarios.php";
                        });
            }

        }

        function SelectAlmacen() 
        {            
         $("#area").prop("checked", false) ;
         $("#almacen").prop("checked", true) ;
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 4})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                    });
        }

        function SelectArea() 
        {
         $("#almacen").prop("checked", false);
         $("#area").prop("checked", true);
            $.post("../../Funciones/llenarSelect.php", {valor_Rb: 2})
                    .done(function(data) {
                        $("#cbModulos").html(data);
                        $("#cbModulos").val(0);
                        
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
                
                var antiguo=$('#antiguo').val();
                
                $.post("../../Funciones/llenarSelect.php", {valor_Rb: val,antiguo:antiguo})
                        .done(function(data) {
                           
                            $("#cbModulos").html(data);
                            if(val!==2)
                            {
                                $("#cbModulos").val(antiguo);
                            }else
                            {
                                $("#cbModulos").val(0);    
                            }
                            
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
