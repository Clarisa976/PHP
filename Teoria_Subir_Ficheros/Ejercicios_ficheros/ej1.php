<?php 
    //controlar que haya introducido un número
    function numero_valido($texto){

    }
    //control de errores
    $error_numero = $_POST["numero"]=="";
    if (isset($_POST["btnEnviar"])) {
        # code...
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de ficheros - Ejercicio 1</title>
</head>
<body>
    <form action="ej1.php" method="post">
        <h1>Ejercicio 1</h1>
        <p>
        <label for="numero">Introduce un número del 1 al 10</label>
        <input type="text" name="numero" id="numero">
        </p>
        <button type="submit" name="btnEnviar">Multiplicar</button>
    </form>
</body>
</html>