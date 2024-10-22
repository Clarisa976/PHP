<?php
    
        if (isset($_POST["btnGenerar"])) {
            function generarClave() {
                //cosas
            }
            
        }
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 </title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>
    <form action="ejercicio1.php" method="post">
        <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
        <button type="submit" name="btnGenerar">Generar</button>
    </form>
    <?php
        if (isset($_POST["btnGenerar"])) {
            echo "<h2>Respuesta</h2>";
            echo"<textarea name='txtGenerado' id='txtGenerado'>".generarClave()."</textarea>";
        }
    ?>
</body>
</html>