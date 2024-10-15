<?php
//control de errores
if (isset($_POST['comparar'])) {
    $texto = trim($_POST['txtQuitarAcentos']); //quitamos espacios
    $error_form = $texto == "";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
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