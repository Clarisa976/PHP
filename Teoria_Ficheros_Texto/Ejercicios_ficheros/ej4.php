<?php
//función que comprueba si tiene o no extensión el fichero introducido
function tiene_extension($texto)
{
    $array_extension = explode(".", $texto);
    if (strtolower(end($array_extension)) == "txt"){
            $respuesta = "txt";
        }else{
            $respuesta = false;
        }
    return $respuesta;
}

if (isset($_POST["btnEnviar"])) {
    //comprobar errores
    $error_fichero = $_FILES["fichero"]["error"] || !tiene_extension($_FILES["fichero"]["name"]) || $_FILES["fichero"]["size"] > 2500 * 1040;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de fichero - Ejercicio 4</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ej4.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fichero">Seleccione un fichero de texto para contar sus palabras(Máx. 2,5MB): </label>
            <input type="file" name="fichero" id="fichero">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'> Campo vacío.</span>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<span class='error'> Error al intentar subir el fichero al servidor.</span>";
                } else if (!tiene_extension($_FILES["fichero"]["name"])) {
                    echo "<span class='error'> No has seleccionado un fichero txt.</span>";
                } else {
                    echo "<span class='error'> El tamaño del fichero de texto supera los 2,5 MB.</span>";
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Contar palabras</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnEnviar"]) && !$error_fichero) {
        
        $nombre_fichero = $_FILES["fichero"]["tmp_name"];
        @$file = fopen($nombre_fichero, "r");
        if (!$file) {
            die("<p>No se puede abrir el fichero</p>");
        }
        $numero_palabras = 0; //contador
        while (!feof($file)) {
            $linea = fgets($file);
            if (trim($linea) == "") {
                continue;
            }
            $numero_palabras += str_word_count($linea);
           
        }
        fclose($file);
        echo "<h3>El archivo contiene " . $numero_palabras . " palabras</h3>";
    }
    ?>
</body>

</html>