<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej7 POO</title>
</head>
<body>
    <h1>Ejercicio 7 POO</h1>
    <?php
        require "class_pelicula.php";
        $pelicula = new Pelicula();
        echo "<p><strong>Título: </strong><br>";
        echo "<p><strong>Director: </strong><br>";
        echo "<p><strong>Año de estreno: </strong><br>";
        echo "<p><strong>Precio: </strong><br>";

        //if
        echo "<p><strong>Estado: </strong><br>";

        echo "<p><strong>Fecha prevista devolución: </strong></p>";
        echo "<p><strong>Recargo actual: </strong></p>";
        
        
        
    ?>
</body>
</html>