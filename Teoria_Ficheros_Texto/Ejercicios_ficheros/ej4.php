<?php
if (isset($_POST["btnEnviar"])) {
    //comprobar errores
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] !="text/plain" || $_FILES["fichero"]["size"] > 2500*1024;
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
            <input type="file" name="fichero" id="fichero" accept=".txt">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'> Campo vacío.</span>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<span class='error'> Error al intentar subir el fichero al servidor.</span>";
                } else if ($_FILES["fichero"]["type"]!="text/plain") {
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
        //version de miguel ángel:
        $contenido_fichero = file_get_contents($_FILES["fichero"]["tmp_name"]);
        $palabras = str_word_count($contenido_fichero);
        echo "<h3>El archivo contiene " . $palabras . " palabras</h3>";
        /*
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
        echo "<h3>El archivo contiene " . $numero_palabras . " palabras</h3>";*/
    }
    ?>
</body>

</html>