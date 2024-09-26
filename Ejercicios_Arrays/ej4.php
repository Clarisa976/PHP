<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
    /*Crea un array e introduce los siguientes valores: 
    Pedro,Ana,34 y 1, respectivamente sin asignar el índice de la matriz.
    Muestra el esquema del array con print_r()*/

    $array[]="Pedro";
    $array[]="Ana";
    $array[]=34;
    $array[]=1;
    echo "<h1>Mostrar la array con print_r</h1>";
    print_r($array);
    
    ?>
</body>
</html>