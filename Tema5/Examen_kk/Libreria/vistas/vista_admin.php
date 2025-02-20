<?php
//llamamos al servicio para ver los libros
$headers[] = "Authorization: Bearer" . $_SESSION['token'];
$url = DIR_SERV . "/obtenerLibros";
//$datos_env["lector"] = $_POST["usuario"];
//$datos_env["clave"] = md5($_POST["clave"]);
$respuesta = consumir_servicios_REST($url, "GET");
$json_respuesta = json_decode($respuesta, true);
if (!$json_respuesta) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: $url</p>"));
}
if (isset($json_respuesta["error"])) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_respuesta["error"] . "</p>"));
}
if (isset($json_respuesta["mensaje"])) {
    $error_usuario = true;
} else {
    $_SESSION["token"] = $json_respuesta["token"];
    $_SESSION["ultm_accion"] = time();
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["lector"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>
    <div>
        <h2>Listado de los libros</h2>
        <?php
        //listamos los libros en una tabla 
        echo "<table>";
        echo "<tr><th>Ref</th><th>Título</th><th>Acción</th></tr>";
        echo "<td>";
        foreach ($json_respuesta["libros"] as $libro) {
            echo "<tr>";
            echo "<td>" . $libro["ref"] . "</td>";
            echo "<td class='enlace'>" . $libro["titulo"] . "</td>";
            echo "<td><form action='index.php' method='post'><input type='hidden' name='ref' value='" . $libro["ref"] . "'><button type='submit' name='btnBorrar'class='enlace'>Borrar</button> - <button type='submit' name='btnEditar'class='enlace'>Editar</button></form></td>";
            echo "</tr>";
        }
        echo "<td>";
        echo "</table>";
        ?>
    </div>
</body>

</html>