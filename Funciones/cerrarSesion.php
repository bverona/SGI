<?php

    session_name("SGI");
    session_start();
    
    unset($_SESSION["usuario"]);
    unset($_SESSION["permisos"]);

    
    header("location:../index.php");

?>
