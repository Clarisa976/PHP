<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej1 POO</title>
</head>
<body>
    <h1>Ejercicio 1 POO</h1>
    <?php
        require "class_fruta.php";

        //creamos una fruta
        $pera=new Fruta();
        //no se pone . porque es para concatenar, por eso se sa la flecha (->)
        $pera->setColor($verde);
        $pera->setTamanio($medianita);

        echo "<h2>Informacion de mi fruta pera</h2>";
        echo "<p><strong>Color: </strong>".$pera->getColor()."<br>";

        echo "<strong>Tamaño: </strong>".$pera->getTamanio()."</p>";
    ?>
</body>
</html>