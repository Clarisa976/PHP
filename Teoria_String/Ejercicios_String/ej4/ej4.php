<?php
//control de errores
if(isset($_POST["comparar"])){
    //comprobar si es solo letras
    function todo_letras($palabra){
        for ($i=0; $i < strlen($palabra); $i++) {
            $todo_l=true; 
            if(ord($palabra[$i])<ord("A") || ord($palabra[$i])>ord("z")){
                $todo_l=false;
                break;
            }
        }
        return $todo_l;
    }

    
    //errores
    $texto = trim($_POST["texto"]);
    $texto_m = strtoupper($texto);
    $texto_limpio = str_replace(" ", "", $texto_m);
    $longitud_texto= strlen($texto_limpio);
    $error_texto=($texto=="" || $longitud_texto<3 || !todo_letras($texto_limpio));
    $error_form = $error_texto;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
            background-color: lightgreen;
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