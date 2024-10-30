<?php
//control de errores
if (isset($_POST['comparar'])) {
    $primera = trim($_POST['primera']); //quitamos espacios
    $segunda = trim($_POST['segunda']);
    $letra_primera_palabra = strlen($primera); //tamaño
    $letra_segunda_palabra = strlen($segunda);
    $error_primera = $primera == "" || $letra_primera_palabra < 3; //controlamos que sean como mínimo tres caracteres
    $error_segunda = $segunda == "" || $letra_segunda_palabra < 3;
    $error_form = $error_primera || $error_segunda;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        body {
            background-color: beige;
            padding: 10px;
        }

        .principal {
            border: 1px solid;
            background-color: lightblue;
            margin-bottom: 5px;
            padding: 5px;
        }

        .centro {
            text-align: center;
        }

        .error {
            color: red;
        }

        .respuesta {
            border: 2px solid;
            padding: 5px;
        }

        .verde {
            background-color: lightgreen;
        }

        .rojito {
            background-color: #ff5942;
        }
    </style>
</head>

<body>
<?php
if (isset($_POST["comparar"])&& !$error_form) {
    require "vistas/vista_formulario.php";
    require "vistas/vista_respuesta.php";
} else {
    require "vistas/vista_formulario.php";
}

?>
</body>

</html>