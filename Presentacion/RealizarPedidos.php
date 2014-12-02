<?php   
    session_name("SGI");
    session_start();
    
    if ( (!isset($_SESSION["usuario"])) || ($_SESSION["permisos"]!=2)){
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

    <title>Realizar Pedido</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/Jumbotron.css" rel="stylesheet">

  </head>

  <body onload="llenarArticulo();" >

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

      <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6">		
                    <form action="../Funciones/InsertaPedidos.php" method="POST" role="form">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="cbtipo">Tipo Artículo</label>
                                <select class="form-control" id="cbtipo" name="cbtipo" onchange="llenarArticulo();"onload="Unidad();" >
                                    <?php
                                        require_once '../Clases/clsTipo.php';
                                        $objTipo = new TipoArticulo();
                                        $objTipo->SelectTipoArticulo();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">                        
                            <div class="form-group">
                                <label for="cbarticulo">Artículo</label>

                                <select class="form-control" id="cbarticulo" name="cbarticulo" onchange="Unidad()" >

                                </select>
                            </div>    
                        </div>    
                        <div class="form-group">
                            <div class="col-xs-8">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" id="cantidad" data-toggle="tooltip" data-placement="bottom" title="Solo Números" name="cantidad" class="form-control">
                            </div>    
                            <div class="col-xs-4">
                                <label for="unidad">Unidad</label>
                                <input type="text" id="unidad" readonly name="unidad" class="form-control">
                            </div>    
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12">    
                                <div class="col-xs-5">
                                <br>    
                                <button class="btn btn-primary" type="button" id="añade" value="Añadir Artículo" onclick="AñadePedido();">Añadir Pedido</button>
                                </div>
                                <div class="col-xs-offset-3 col-xs-2 ">    
                                <br>
                                <input type="button" class="btn btn-primary btn-success" onclick="EnviaPedido();"  value="Enviar Pedidos">
                                </div>
                                <input type="hidden" value="" name="arreglo" id="arreglo">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      </div>
      <br>
            <div class="row">
              <div class="table-responsive">          
                <div class="col-xs-12 col-md-offset-2 col-md-6 col-lg-offset-2 col-lg-6">
                    <table class="table table-striped table-condensed table-hover" id="tabla">
			<thead>
				<tr>
					<th>Tipo Artículo</th>
					<th>Artículo</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="bodytabla">

			</tbody>
                    </table>

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
        $(document).ready(function (){
          $('#cantidad').tooltip();
          $('#cantidad').keyup(function (){
            this.value =(this.value + '').replace(/[^0-9]/,'');
            Unidad();
        });
        });
        
        function PedidoTabla(){
        var html ="<tr><td>"+$("#cbtipo option:selected").html()+"</td><td>"+$("#cbarticulo option:selected").html()+"</td><td>"+$("#cantidad").val()+"</td><td>"+$("#unidad").val()+"</td></tr>";
        $("#bodytabla").append(html);
            $("#cbtipo").val("");
            $("#cbarticulo").val("");
            $("#cantidad").val("");
        };

        function EnviaPedido()
        {       
            var texto =JSON.stringify(arreglo);
            
            $("#arreglo").val(texto);            
            $.post("../Funciones/InsertaPedidos.php",{arreglo:arreglo})
            .done(function(data)
            {
                $("#cbtipo").val("");
                $("#cbarticulo").val("");
                $("#cantidad").val("");
                alert("Pedido Enviado");
                arreglo=new Array();
            });
        }
        function AñadePedido()
        {
          
            if(($("#cbtipo").val()===null))
            {
                $('#cbtipo').focus();
                $('#cbtipo').tooltip('show');                
            }
            else 
                if($("#cbarticulo").val()===null)
                {
                    $('#cbarticulo').focus();
                    $('#cbarticulo').tooltip('show');                
                }
                else 
                    if(($("#cantidad").val()==="")){
                        $('#cantidad').focus();
                        $('#cantidad').tooltip('show');
                    }
                    else 
                    {
                        arreglo.push([$("#cbarticulo").val(),$("#cantidad").val()]); //funciona
                        PedidoTabla();
                    }
            //alert(arreglo[arreglo.length-1][0]+" "+arreglo[arreglo.length-1][1]+" "+arreglo[arreglo.length-1][2]);
            
    }    
       
        function Unidad()
        {
            var id = $("#cbarticulo").val();
            $.post("../Funciones/DatosArticulo.php",{id:id})
            .done(function(data)
            {
     
                data = $.parseJSON(data);
                $("#unidad").val(data.unidad)
            });
    
        }
        
        function llenarArticulo(){
        var tipoArticulo = $("#cbtipo").val();
        $("#cbarticulo").html("");
        
        $.post("../Funciones/llenarArticulo.php",{tipo_articulo:tipoArticulo})
            .done(function( data ) {
                $("#cbarticulo").html(data);
                Unidad();
    });
            
        }
        
        
        
        
    </script>
  </body>
</html>
