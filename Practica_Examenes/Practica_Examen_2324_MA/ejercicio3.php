<?php
if (isset($_POST["btnCodificar"])) {
    $error_texto = $_POST["texto"] == "";
    $error_despl = $_POST["despl"] == ""  || $_POST["despl"] < 1 || $_POST["despl"] > 26;
    $error_archivo = $_FILES["archivo"]["error"] || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1.25 * 1024 * 1024;
    $error_form = $error_texto || $error_despl || $error_archivo;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Exam 23_24</title>
    <style>
        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Ejercicio 3. Codifica una Frase</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduzca una Frase: </label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"]; ?>">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_texto)
                echo "<span class='error'> Campo vacío </span>";
            ?>
        </p>
        <p>
            <label for="despl">Introduzca un Desplamiento: </label>
            <input type="text" name="despl" id="despl" value="<?php if (isset($_POST["despl"])) echo $_POST["despl"]; ?>">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_despl)
                if ($_POST["despl"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                else
                    echo "<span class='error'> Desplazamiento no válido </span>";
            ?>
        </p>
        <p>
            <label for="archivo">Seleccione el archivo de claves (.txt y menor 1'25 MB)</label>
            <input type="file" name="archivo" id="archivo" accept=".txt">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_archivo) {
                if ($_FILES["archivo"]["name"] == "")
                    echo "<span class='error'> <-- * </span>";
                elseif ($_FILES["archivo"]["error"])
                    echo "<span class='error'>Error en la subida del fichero</span>";
                elseif ($_FILES["archivo"]["type"] != "text/plain")
                    echo "<span class='error'>Error: no has seleccionado un fichero de texto</span>";
                else
                    echo "<span class='error'>Error: el tamaño del fichero supera los 1'25 MB</span>";
            }
            ?>
        </p>
        <p>
            <button name="btnCodificar" type="submit">Codificar</button>
        </p>
    </form>
    <?php
    if (isset($_POST["btnCodificar"]) && !$error_form) {
        echo "<h1>Respuesta</h1>";
        @$fd = fopen($_FILES["archivo"]["tmp_name"], "r");
        if (!$fd)
            die("<p>No se ha podido abrir el fichero de claves seleccionado</p>");

        $primera_linea = fgets($fd);

        while ($linea = fgets($fd)) {
            $datos_linea = explode(";", rtrim($linea));
            $datos_linea[26] = $datos_linea[0];
            $claves[$datos_linea[0]] = $datos_linea;
        }
        fclose($fd);

        $texto = $_POST["texto"];
        $despl = $_POST["despl"]%26;
        $respuesta = "";
        for ($i = 0; $i < strlen($texto); $i++) {
            if ($texto[$i] >= "A" && $texto[$i] <= "Z")
                $respuesta .= $claves[$texto[$i]][$despl];
            else
                $respuesta .= $texto[$i];
        }
        echo "<p>El texto introducido codificado sería: <br>" . $respuesta . "</p>";
    }
    ?>

</body>

</html>