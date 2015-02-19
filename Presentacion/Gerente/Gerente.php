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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Bruno Verona">
        <link rel="icon" href="../../Imagenes/logo muni motupe.png">

        <title>Modulo Administrador</title>

        <!--Bootstrap-->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Personaliza este archivo -->
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
            <div class="jumbotron">
                <h1>Sistema de Gestión De Inventario</h1>
                <p>Sistema Desarrollado para Controlar y Monitorear el Inventario de la Municipalidad Distrital de Motupe</p>

            </div>


        </div> <!-- /container -->


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
                            document.location.href = "ListarUsuarios.php";
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
