<?php
session_name('Examen3_PHP_24-25');
session_start();
require 'src/funciones_ctes.php';

if (isset($_POST['btnSalir'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
if (isset($_SESSION['token'])) {
    require 'src/seguridad.php';
    //si el usuario está en la base de datos se muesta las tablas y sino se muestra el login
    if(is_array($datos_usuario_log) && !empty($datos_usuario_log)){
        require 'vistas/vista_tablas.php';
    }else {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}else{
    require 'vistas/vista_login.php';
}
?>