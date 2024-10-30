<?php
const VALIDOS = ['M', 'D', 'C', 'L', 'X', 'V', 'I'];

//control de errores
if (isset($_POST["comparar"])) {
    //comprobar si es solo letras
    function todo_letras($palabra){
        for ($i = 0; $i < strlen($palabra); $i++) {
            $todo_l = true;
            if (ord($palabra[$i]) < ord("A") || ord($palabra[$i]) > ord("z")) {
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    function es_numero_romano_valido($texto){
        $texto_m = strtoupper($texto);  //se transforma el texto a mayusculas
        $validos = ['M', 'D', 'C', 'L', 'X', 'V', 'I'];  //números romanos válidos

        for ($i = 0; $i < strlen($texto_m); $i++) {
            if (!in_array($texto_m[$i], $validos)) {  //si hay algun valor no válido
                return false;
            }
        }
        return true;
    }
    //versión de miguel ángel
    function letras_correctas($texto){
       $correcto = true;
        for ($i = 0; $i < strlen($texto); $i++) {
            if (!isset(VALIDOS[$texto[$i]])) {//si hay algun valor no válido
                $correcto = false;
                break;
            }
        }
        return $correcto;
    }
    function orden_bueno($texto){
        $bueno=true;
        for ($i = 0; $i < strlen($texto); $i++) {
            if ((VALIDOS[$texto[$i]])<(VALIDOS[$texto[$i+1]])) {//comprobamos si el valor actual es menor que el siguiente
                $bueno=false;
                break;
            }
        }
        return $bueno;
    }
    function repite_bien($texto){
        $contador["M"]=4;
        $contador["D"]=1;
        $contador["C"]=4;
        $contador["L"]=1;
        $contador["X"]=4;
        $contador["V"]=1;
        $contador["I"]=4;
        $bueno=true;
        for ($i = 0; $i < strlen($texto); $i++) {
            $contador[$texto[$i]]--;
            if ($contador[$texto[$i]]<0) {
               $bueno = false;
               break;
            }
        }
        return $bueno;

    }

    function bien_escrito_romano($texto){
        return letras_correctas($texto)&& orden_bueno($texto)&&repite_bien($texto);
    }

    //errores
    $texto = trim($_POST["texto"]);
    $texto_m = strtoupper($texto);
    $longitud_texto = strlen($texto_m);
    //$error_texto = ($texto_m == "" || !bien_escrito_romano($texto_m));
    $error_texto = ($texto_m == "" || !es_numero_romano_valido($texto_m));
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
    if (isset($_POST["comparar"]) && !$error_form) {
        require "vistas/vista_formulario.php";
        require "vistas/vista_respuesta.php";
    } else {
        require "vistas/vista_formulario.php";
    }

    ?>
</body>

</html>