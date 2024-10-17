<?php
if (isset($_POST["btnEnviar"])) {
    //comprobar errores
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 2500 * 1024;

    //url: http://dwese.icarosproject.com/PHP/datos_ficheros.txt
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de fichero - Ejercicio 5</title>
    <style>
        .error {
            color: red;
        }
        table{
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <form action="ej5.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 5</h1>

    </form>
    <?php
    @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
        while (!feof($file)) {
            $linea = fgets($file);
            echo "<p>".$linea."</p>";
           
        }
    ?>
</body>

</html>