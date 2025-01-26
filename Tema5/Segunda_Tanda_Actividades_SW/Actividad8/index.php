<?php
session_name("Actividad8");
session_start();
require "src/funciones_ctes.php";

if (isset($_POST["btnCerrarSesion"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}
if (isset($_SESSION["token"])) {
    
    require "src/seguridad.php";
    if ($datos_usuario_log["tipo"]==="admin") {
        require "vistas/admin.php";
    }else{
        require "vistas/normal.php";
    }
}else{
    require "vistas/login.php";
}
?>