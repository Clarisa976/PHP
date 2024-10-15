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

    //comprobar si es solo números
    function todo_numeros($palabra){
        $todo_num = true;
        for ($i=0; $i < strlen($palabra); $i++){
            if (!is_numeric($palabra[$i])) {
                $todo_num = false;
            }
        }
        return $todo_num;
       /* for ($i=0; $i < strlen($palabra); $i++) {
            if(!ctype_digit($palabra[$i])){
                return false;
            }
        }
        return true;*/
    }
    //errores
    $texto = trim($_POST["texto"]);
    $longitud_texto= strlen($texto);
    $error_texto=($texto=="" || $longitud_texto<3 || (!todo_letras($texto) && !todo_numeros($texto)));
    $error_form = $error_texto;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
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