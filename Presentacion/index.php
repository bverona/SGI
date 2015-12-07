<?php
    if (isset($_COOKIE["usuario"])){
        $usuario = $_COOKIE["usuario"];
        echo $usuario ;
        
    }else{
        $usuario = "";
    }
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="SGI">
    <meta name="author" content="Bruno Verona">

    <title>SGI - Inicio Sesión</title>

    <!-- Bootstrap core CSS -->
     <link href="../../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../bootstrap/css/css_login.css" rel="stylesheet">
    
    
  </head>
    <body>
        <div class="wrapper">
        <div class="container">
  

            <form class="form-signin" id="login" role="form" action="../Funciones/login.php" method="post">
                <div class="text-center">
                    <img id="avatar" src="../Imagenes/usuario2.png" alt="avatar">
			<h1><strong> BIENVENIDOS</strong></h1>
                </div>
                <input type="input" class="form-control" placeholder="Usuario" name="txtusuario" value="<?php echo $usuario; ?>" required autofocus>
                <p></p>
                <input type="password" class="form-control" placeholder="Contraseña" name="txtpass" required>
                <button class="btn btn-lg btn btn-default btn-block" type="submit">Ingresar</button>
            </form>

  
        </div>
       
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
        </div>
    <script src="../Jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>
