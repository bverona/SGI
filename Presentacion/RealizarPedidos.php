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

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="creaArreglo();">

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"></span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
              <a type="button" class="navbar-brand btn btn-default" href="RealizarPedidos.php">Realizar Pedido</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-brand"><?php echo date('d/m/Y'); ?></li>
                <li class="dropdown">                
                <a href="#" class="dropdown-toggle " data-toggle="dropdown"><?php echo $_SESSION['usuario'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ActualizarDatos.php">Modificar Datos</a></li>
                    <li><a href="../Funciones/CerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <div class="jumbotron">
            <div class="row">            
                <div class="col-xs-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6">		
                    <form action="../Funciones/NuevoPedido.php" method="POST" role="form">
                         <div class="form-group">
                                <label for="elemento">Escriba una descripción de su pedido</label>
                                <textarea class="form-control" rows="5" name="elemento" maxlength="300" id="elemento"></textarea>
                        </div>
                         <div class="form-group">
                        <p><button class="btn btn-primary" type="button" value="Añadir Artículo" onclick="AñadeArreglo();">Añadir Pedido</button></p>
                        <p><input type="button" class="btn btn-primary btn-success" onclick="EnviarArreglo();" value="Enviar Pedidos"></p>
                        </div>
                    </form>
                </div>
            </div>          
      </div>

      <!-- Main component for a primary marketing message or call to action -->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../Jquery/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
       var arreglo= new Array(); 

        function AñadeArreglo()
        {
         arreglo.push($("#elemento").val()); 
         $("#elemento").val("");         
        }

        function EnviarArreglo()
        {

            $.post("../Funciones/InsertaPedidos.php",{arreglo:arreglo})
                    .done(function(data){
                alert("funco!! "+data);
            });
    
        }
        
        
    </script>
  </body>
</html>
