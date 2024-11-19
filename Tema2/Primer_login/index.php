<?php
session_start();

require "src/funciones_ctes.php";
if(isset($_POST["btnCerrarSession"])){
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])){
    //control de baneo

    //vista después del login
    require "vistas/vista_logueado.php";
}else{
    require "vistas/vista_login.php";
}
