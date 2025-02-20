<?php
session_name("guardias");
session_start();
require "src/funciones_ctes.php";

//si hay botón para salir
if (isset($_POST['btnSalir'])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

//si se ha generado un token
if(isset($_SESSION['token'])){
    //control de baneo
    require "src/seguridad.php";

    if (isset($datos_usuario_log['usuario'])) {
        require "vistas/equipos.php";
    }
}else{
    require "vistas/login.php";
}
?>