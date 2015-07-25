<?php
    if (isset($_COOKIE["usuario"])){
        $usuario = $_COOKIE["usuario"];
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
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

        <form class="form-signin" role="form" action="login.php" method="post">
        <div>   <h2 class="form-signin-heading ">Inicio Sesión</h2></div>
        <input type="input" class="form-control" placeholder="Usuario" name="txtusuario" value="<?php echo $usuario; ?>" required autofocus>
        <p></p>
        <input type="password" class="form-control" placeholder="Contraseña" name="txtpass" required>
        <button class="btn btn-lg btn btn-success  btn-block" type="submit">Ingresar</button>
      </form>
    </div>


  </body>
</html>
