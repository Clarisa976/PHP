<?php
//control de errores 
if (isset($_POST["btnEnviar"])) {
    //comprobar errores
    //si hay algún error
    //si no es txt
    //si es mayor que 1mb
    //si ha subido algo
    $error_formulario = $_FILES["fichero"]["name"] == "" ||
        $_FILES["fichero"]["error"] ||
        $_FILES["fichero"]["type"] != "text/plain" ||
        $_FILES["fichero"]["size"] > 1000 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>.error{color:red;}</style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    if (isset($_POST["btnEnviar"]) && !$error_formulario) {
        //movemos el fichero
        $aux = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");
        if (!$aux) {
            echo "<p class='error'>El fichero no se ha movido con éxito</p>";
        }
    }

    @$fd = fopen("Horario/horarios.txt", "r");
    if ($fd) {
        echo "<h2>Horario de los Profesores</h2>";
        fclose($fd);
    } else {

    ?>
        <h2>No se encuentra el archivo <em>Horario\horarios.txt</em></h2>

        <form action="ej4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Seleccione un fichero .txt de máximo 1MB</label>
                <input type="file" name="fichero" id="fichero">
                <?php
                //controlamos los errores a mostrar
                if (isset($_POST["btnEnviar"]) && $error_formulario) {
                    if ($_FILES["fichero"]["name"] == "") {
                        echo "<span class='error'>Campo vacío</span>";
                    } elseif ($_FILES["fichero"]["type"] != "text/plain") {
                        echo "<span class='error'>La extensión del fichero no es la adecuada</span>";
                    } else {
                        echo "<span class='error'>El tamaño del fichero es superior a 1MB</span>";
                    }
                }
                ?>
            </p>
            <button type="submit" name="btnEnviar">Subir fichero</button>
        </form>
    <?php
    }
    ?>
</body>

</html>