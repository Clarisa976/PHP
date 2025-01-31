<?php
        //llamamos al servicio para ver los libros        
        $url = DIR_SERV . "/obtenerLibros";
        $respuesta = consumir_servicios_REST($url, "GET");
        $json_respuesta = json_decode($respuesta, true);
        if (!$json_respuesta) {
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: $url</p>"));
        }

        if (isset($json_respuesta["error"])) {
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_respuesta["error"] . "</p>"));
        }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .libros{
            display:flex;
            flex-flow: row wrap;
            justify-content: space-around;            
        }
    </style>
</head>

<body>
    <h2>Listado de los libros</h2>
    <div class="libros">
        <?php
        foreach ($json_respuesta["libros"] as $libro) {
            echo "<div>";
            echo "<img src='portadas/" . $libro["portada"] . "' alt='portada'>";
            echo "<p>Titulo: " . $libro["titulo"] . "</p>";
            echo "<p>Autor: " . $libro["autor"] . "</p>";
            echo "<p>Editorial: " . $libro["editorial"] . "</p>";
            echo "<p>ISBN: " . $libro["isbn"] . "</p>";
            echo "<p>Precio: " . $libro["precio"] . "</p>";
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>