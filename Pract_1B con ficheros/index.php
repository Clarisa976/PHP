<?php
function LetraNIF($dni) 
{  
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1); 
}
function dni_valido($dni){
    if ($_POST["DNI"]!=9) {
        echo "<span class='error'>DNI no válido</span>";
    }else {
        # code...
    }
}

function tiene_extension($texto){
    $array_nombre=explode(".",$texto);
    if (count($array_nombre)<=1) {//si no tiene extensión devuelve falso
        $respuesta = false;
    }else{
        $respuesta=end($array_nombre);
    }
    return $respuesta;
}

if (isset($_POST["btnEnviar"])) {
    $error_foto=$_FILES["foto"]["name"]!=""//si hay imagen y se cumple todo lo demás, si no hay imagen pasando
    &&($_FILES["foto"]["error"]
    || !tiene_extension($_FILES["foto"]["name"])
    || !getimagesize($_FILES["foto"]["tmp_name"])
    || $_FILES["foto"]["size"]>500*1024);
}

//así tendríamos el efecto del reset
if(isset($_POST["btnBorrar"])){
    header("Location:index.php");
    exit;
}
if (isset($_POST["btnEnviar"])) {
    //comprobamos errores en el formulario
    $error_nombre = $_POST["nombre"] == "";
    $error_apellidos = $_POST["apellidos"] == "";
    $error_pass = $_POST["pass"] == "";
    $error_DNI = $_POST["DNI"] == "";
    $error_sexo = !isset($_POST["sexo"]);
    $error_comentarios = $_POST["comentarios"] == "";

    $errores_form = $_FILES["foto"]["name"]!="" &&($_FILES["foto"]["error"]
        || !tiene_extension($_FILES["foto"]["name"])
        || !getimagesize($_FILES["foto"]["tmp_name"])
        || $_FILES["foto"]["size"]>500*1024) 
    || $error_nombre
    || $error_apellidos 
    || $error_pass
    || $error_DNI 
    || $error_sexo 
    || $error_comentarios;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["btnEnviar"]) && !$errores_form) {
        require "vistas/vista_recogida.php";
    } else {
        require "vistas/vista_formulario.php";
    }
    ?>
</body>

</html>