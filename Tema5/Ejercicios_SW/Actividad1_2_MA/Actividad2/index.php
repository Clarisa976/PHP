<?php
session_name("Actividad2");
session_start();
require "src/funciones_ctes.php";

// Errores del formulario
if(isset($_POST["btnContAgregar"])){
    // Codigo
    $error_cod = $_POST["cod"]=="";
    if(!$error_cod){
        $url = DIR_SERV . "/repetido/producto/cod/".urlencode($_POST["cod"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $json_repetido = json_decode($respuesta, true);
        if (!$json_repetido)
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

        if (isset($json_repetido["error"]))
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

        if (isset($json_repetido["mensaje"]))
            die(error_page("Actividad 2", "<p>" . $json_repetido["mensaje"] . "</p>"));

        $error_cod = $json_repetido["repetido"];
    }
    // Nombre corto
    $error_nombre_corto = $_POST["nombre_corto"]=="";
    if(!$error_nombre_corto){
        $url = DIR_SERV . "/repetido/producto/nombre_corto/".urlencode($_POST["nombre_corto"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $json_repetido = json_decode($respuesta, true);
        if (!$json_repetido)
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

        if (isset($json_repetido["error"]))
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

        if (isset($json_repetido["mensaje"]))
            die(error_page("Actividad 2", "<p>" . $json_repetido["mensaje"] . "</p>"));

        $error_nombre_corto = $json_repetido["repetido"];
    }
    // Nombre no controla errores

    // Error descripcion
    $error_descripcion = $_POST["descripcion"]=="";
    // PVP
    $error_pvp = $_POST["pvp"]=="" || !is_numeric($_POST["pvp"]) || $_POST["pvp"]<=0;

    $error_form=$error_cod || $error_descripcion || $error_nombre_corto || $error_pvp;

    if(!$error_form){
        // Inserto y salgo con mensaje
        $url = DIR_SERV . "/producto/insertar";
        $respuesta = consumir_servicios_REST($url, "POST",$_POST);
        $json_insertar = json_decode($respuesta, true);
        if (!$json_insertar)
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

        if (isset($json_insertar["error"]))
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

        $_SESSION["mensaje"]="Producto insertado con éxito";
        header("location:index.php");
        exit;
    }else{

    }

}

// un producto en concreto
if (isset($_POST["btnDetalles"])) {
    $url = DIR_SERV . "/producto/" . $_POST["btnDetalles"] . "";
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_detalles = json_decode($respuesta, true);
    if (!$json_detalles)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($json_detalles["error"]))
        die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

    if (isset($json_detalles["mensaje"]))
        die(error_page("Actividad 2", "<p>" . $json_detalles["mensaje"] . "</p>"));
}

// Si pulsamos continuar borrado
if (isset($_POST["btnContBorrar"])) {
    $url = DIR_SERV . "/producto/borrar/" . $_POST["btnContBorrar"] . "";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $json_borrar = json_decode($respuesta, true);
    if (!$json_borrar)
        die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

    if (isset($json_borrar["error"]))
        die(error_page("Actividad 2", "<p>" . $json_borrar["error"] . "</p>"));

    $_SESSION["mensaje"] = "Se ha eliminado el producto: " . $_POST["btnContBorrar"];
    header("Location:index.php");
    exit;
}

// Pulsamos boton agregar
if (isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form)) {
    $url = DIR_SERV . "/familias";
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_familias = json_decode($respuesta, true);
    if (!$json_familias)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($json_familias["error"]))
        die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));

    if (isset($json_familias["mensaje"]))
        die(error_page("Actividad 2", "<p>" . $json_familias["mensaje"] . "</p>"));
}


// Listar los productos nada mas iniciar
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET");
$json_productos = json_decode($respuesta, true);
if (!$json_productos)
    die(error_page("Actividad 2", "<p> Error consumiendo el servicio rest:" . $url . "</p>"));

if (isset($json_productos["error"]))
    die(error_page("Actividad 2", "<p>" . $json_productos["error"] . "</p>"));


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
    <style>
        .centrado {
            width: 85%;
            margin: 0 auto;
        }

        .txt_centrado {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 0.5rem;
        }

        th {
            background-color: #CCC;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        .enlace {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
            background: none;
            border: none
        }
    </style>
</head>

<body>
    <h1 class="centrado txt_centrado">Listado de los productos</h1>
    <?php

    // Si existe el botón agregar
    if(isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form)){
        require "vistas/vista_agregar.php";
    }

    // Si existe botón detalles 
    if (isset($_POST["btnDetalles"])) {
        require "vistas/vista_detalles.php";
    }

    // Si existe botón borrar
    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }

    if (isset($_SESSION["mensaje"])) {
        echo "<p class='txt_centrado centrado'>" . $_SESSION["mensaje"] . "</p>";
        session_destroy();
    }

    require "vistas/vista_tabla.php";

    ?>
</body>

</html>